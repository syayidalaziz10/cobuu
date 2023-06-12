<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    public function home()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } else if ($user->level == 'kasir') {
                return redirect()->intended('kasir');
            } else if ($user->level == 'manajer') {
                return redirect()->intended('manajer');
            }
            return redirect()->intended('/');
        }

        $data['title'] = 'Home';
        return view('home', $data);
    }


    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }


    public function createKasir()
    {
        $data['title'] = 'Register';
        return view('user/createkasir', $data);
    }


    public function createManajer()
    {
        $data['title'] = 'Register';
        return view('user/createmanajer', $data);
    }


    public function kasir(Request $request)
    {
        $cari     = $request->get('cari');
        $data = [
            'title' => "Data Kasir",
            'page'  => "kasir",
            'cari' => $cari
        ];

        $data['menu']  = Menu::when($cari, function ($query, $cari) {
            return $query->where('nama_menu', 'like', '%' . $cari . '%');
        })->get();


        return view('kasir/pesanan', $data);
    }

    public function adminBeranda(Request $request)
    {
        $data = [
            'title' => "Beranda",
            'page'  => "beranda",
            'q'     => $request->get('q'),
            'kasir' => User::where('level', '=', 'kasir')->count(),
            'menu' => Menu::count(),
            'admin' => User::where('level', '=', 'admin')->count()
        ];


        return view('/admin/beranda', $data);
    }


    public function adminKasir(Request $request)
    {
        $data = [
            'title' => "Data Kasir",
            'page'  => "kasir",
            'q'     => $request->get('q')
        ];

        $data['users'] = User::where('level', '=', 'kasir')->get();
        return view('admin/kasir', $data);
    }


    public function adminManajer(Request $request)
    {
        $data = [
            'title' => "Data Manajer",
            'page'  => "manajer",
            'q'     => $request->get('q')
        ];

        $data['users'] = User::where('level', '=', 'admin')->get();
        return view('admin/manager', $data);
    }


    public function manajer(Request $request)
    {
        $data['title'] = 'Data Manajer';
        $data['q'] = $request->get('q');
        $data['users'] = User::where('level', '=', 'manajer')
            ->where(function ($query) use ($data) {
                $query->where('nama', 'like', '%' . $data['q'] . '%')->orWhere('username', 'like', '%' . $data['q'] . '%')->orWhere('no_hp', 'like', '%' . $data['q'] . '%');
            })->get();
        return view('user/manajer', $data);
    }

    public function adminMenu()
    {
        $data = [
            'title' => "Data Menu",
            'page'  => "menu",
            'menu' => Menu::join('kategori', 'menu.id_kategori', '=', 'kategori.id_kategori')->get(),
            'kategori' => Kategori::All()
        ];
        return view('admin/menu', $data);
    }


    public function register_action(request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:50',
            'username' => 'required|unique:user|max:16|min:4',
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
            'level' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'gambar' => 'required'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('post-images');
        }

        // $user->save();
        User::create($validatedData);
        // $validatedData->save();
        if ($request->level == 'kasir') {
            return redirect()->route('admin.kasir')->with('success', 'Registration Success Please Login');
        } else if ($request->level == 'admin') {
            return redirect()->route('admin.manajer')->with('success', 'Registration Success Please Login');
        }
        return redirect()->route('home')->with('success', 'Registration Success Please Login');
    }

    public function login()
    {
        $data['title'] = 'Login';
        return view('login', $data);
    }

    public function login_action(Request $request)
    {

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } else if ($user->level == 'kasir') {
                return redirect()->intended('kasir');
            }
        }

        if (User::where('username', $request->username)->exists()) {
            throw ValidationException::withMessages([
                'password' => [Lang::get('Password yang Anda masukkan salah')],
            ]);
        }

        throw ValidationException::withMessages([
            'username' => [Lang::get('Username yang Anda masukkan salah')],
        ]);
    }

    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // public function edit(User $user)
    // {
    //     $data['title'] = 'User';
    //     $data['user'] = $user;
    //     return view('user.edit', $data);
    // }

    public function update(Request $request, User $user)
    {
        // ddd($request);
        // ddd($user);
        $validatedData = $request->validate([
            'nama' => 'required|max:50',
            'username' => 'required|max:16|min:4',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'gambar' => 'image|file|max:2000'
        ]);


        if ($request->file('gambar')) {
            if ($request->profilSekarang != null) {
                Storage::delete($request->profilSekarang);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('post-images');
        }

        User::where('id_user', $request->idUser)->update($validatedData);
        if ($request->level == 'kasir') {
            return redirect()->route('admin.kasir')->with('success', 'Success Update User');
        } else if ($request->level == 'manajer') {
            return redirect()->route('admin.manajer')->with('success', 'Success Update User');
        }
    }

    public function destroy(User $user)
    {
        if ($_GET["gambar"]) {
            Storage::delete($_GET["gambar"]);
        }
        User::destroy($_GET["user"]);
        if ($user->level == 'kasir') {
            return redirect()->route('admin.kasir')->with('success', 'Registration Success Please Login');
        } else if ($user->level == 'manajer') {
            return redirect()->route('admin.manajer')->with('success', 'Registration Success Please Login');
        }
        return redirect()->route('admin')->with('success', 'Registration Success Please Login');
    }
}
