@extends('admin.template.main')
@include('admin.template.sidebar')

@section('content')
{{-- main menu --}}
<?php $i=1; ?>
{{-- <div class="w-full flex justify-center">
    <input type="text" placeholder="Cari User Manager" class="text-white w-full rounded-2xl my-12 py-3 px-16 bg-warna-2 text-secondary text-md">
</div> --}}
{{-- start main menu --}}
<div class="w-full bg-fill p-10 my-14 rounded-xl">
    <div class="flex mt-5 justify-between w-full items-center">
        <h1 class="text-caption text-2xl font-bold">Manajemen Admin</h1>
        <button type="button" data-modal-toggle="staticModal" class="py-3 px-8 bg-primary rounded-md font-semibold text-sm text-fill">Tambah User</button>
    </div>
    <div class="my-10">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-primary uppercase bg-secondary">
                <tr>
                    <th scope="col" class="p-6 rounded-l-xl">
                        No
                    </th>
                    <th scope="col" class="p-6">
                        Nama User
                    </th>
                    <th scope="col" class="p-6">
                        Username
                    </th>
                    <th scope="col" class="p-6 rounded-r-xl">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-fill">
                        <th scope="row" class="p-6 font-medium text-gray-900 whitespace-nowrap">
                            {{$i}}
                        </th>
                        <td class="p-6">
                            {{$user->nama}}
                        </td>
                        <td class="p-6">
                            {{$user->username}}
                        </td>
                        <td class="p-6">
                            <a class="font-medium mr-2 uppercase cursor-pointer text-blue-600 hover:underline" data-modal-toggle="staticModalEdit" onclick="editModal(this);" 
                            data-idUser="{{$user->id_user}}" data-username="{{$user->username}}" data-namaUser="{{$user->nama}}" data-alamat="{{$user->alamat}}"  data-noHp="{{$user->no_hp}}" data-gambar="{{ asset('storage/'. $user->gambar) }}" data-gambarSkg="{{ $user->gambar }}">
                            Edit
                            </a>
                            <form method="POST" class="inline" action="{{ route('user.destroy', ['user' => $user->id_user, 'gambar'=> $user->gambar]) }}" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium uppercase text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- end main menu --}}
{{-- modal tambah user --}}
<div id="staticModal" data-modal-backdrop="static" aria-label="hidden" tabindex="-1" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-5xl h-full md:h-auto">
        <!-- Modal content -->
        <form action="{{ route('register.action') }}" method="POST" enctype="multipart/form-data" class="relative rounded-xl shadow bg-content">
            
            @csrf
            <!-- Modal header -->
            <div class="p-6">
                <div class="flex justify-between items-start p-4 rounded-xl">
                    <h3 class="text-xl font-bold text-caption">
                        TAMBAH USER ADMIN
                    </h3>
                    <button type="button" class="text-componen hover:bg-gray-200 hover:text-gray-900 rounded-lg bg-warna-4 text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="staticModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="flex items-start p-6 space-x-12">
                    {{-- form modal --}}
                    <div class="space-y-3 w-1/2">
                        <div>
                            <h2 class="text-xs font-bold text-caption">AKUN USER ADMIN</h2>
                        </div>
                        <div>
                            <label for="username" class="block text-caption text-sm mb-2">Username</label>
                            <input type="text" id="username" name="username" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                        <div class="flex justify-center items-center space-x-2">
                            <div class="w-1/2">
                                <label for="password" class=" text-caption text-sm">Password</label>
                                <input type="password" id="password" name="password" class=" block w-full mt-2 bg-fill py-2 px-6 rounded-md text-caption">
                            </div>
                            <div class="w-1/2">
                                <label for="konfrimasi" class= "text-caption text-sm">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="konfrimasi" class="block w-full bg-fill mt-2 py-2 px-6 rounded-md text-caption">
                            </div>
                        </div>
                        <div>
                            <label class="text-caption text-sm">Gambar</label>
                            <label for="profil" class="block text-caption mt-2">
                                <div class="bg-fill rounded-md h-48 w-full flex flex-col justify-center items-center py-7 relative cursor-pointer">
                                    <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M76.8492 58.344L64.6394 29.835C60.5045 20.163 52.8978 19.773 47.7876 28.977L40.4149 42.276C36.6701 49.023 29.6875 49.608 24.8504 43.563L23.9922 42.471C18.96 36.153 11.8604 36.933 8.23257 44.148L1.52304 57.603C-3.19704 66.963 3.62952 78 14.0839 78H63.8593C74.0016 78 80.8281 67.665 76.8492 58.344ZM19.4671 23.4C22.5709 23.4 25.5475 22.1673 27.7422 19.9732C29.9369 17.779 31.1698 14.803 31.1698 11.7C31.1698 8.59697 29.9369 5.62103 27.7422 3.42685C25.5475 1.23268 22.5709 0 19.4671 0C16.3634 0 13.3868 1.23268 11.1921 3.42685C8.99742 5.62103 7.76446 8.59697 7.76446 11.7C7.76446 14.803 8.99742 17.779 11.1921 19.9732C13.3868 22.1673 16.3634 23.4 19.4671 23.4Z" fill="#BDCCD4" fill-opacity="0.5"/>
                                    </svg>
                                    <span id="fileName" class="mt-4"></span>
                                    <input type="file" name="gambar" id="profil" class="invisible absolute top-0">
                                </div>
                            </label>
                        </div>
                        <input type="hidden" name="level" value="admin">
                    </div>
                    <div class="w-1/2 space-y-3">
                        <div>
                            <h2 class="text-xs font-bold text-caption">BIODATA USER MANAJER</h2>
                        </div>
                        <div>
                            <label for="namalengkap" class="block text-caption text-sm mb-2">Nama Lengkap</label>
                            <input type="text" id="namalengkap" name="nama" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                        <div>
                            <label for="hp" class="block text-caption text-sm mb-2">No Handphone</label>
                            <input type="text" id="hp" name="no_hp" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                        <div>
                            <label for="alamat" class="block text-caption text-sm mb-2">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                
                <!-- Modal footer -->
                <div class="flex items-center justify-end w-full px-12 py-6 space-x-2 rounded-xl bg-warna-4">
                    <button data-modal-toggle="staticModal" type="button" class="text-primary bg-fill rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">Batal</button>
                    <button data-modal-toggle="staticModal" type="submit" class="text-white bg-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah User</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end modal tambah user --}}

{{-- modal edit user --}}
<div id="staticModalEdit" data-modal-backdrop="static" tabindex="-1" aria-label="hidden" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-5xl h-full md:h-auto">
        <!-- Modal content -->
        <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data" class="relative rounded-xl shadow bg-content">
            @method('POST')
            @csrf
            <!-- Modal header -->
            <div class="p-6">
    
                <div class="flex justify-between items-start p-4 rounded-xl">
                    <h3 class="text-xl font-bold text-caption">
                        EDIT USER ADMIN
                    </h3>
                    <button type="button" class="text-componen hover:bg-gray-200 hover:text-gray-900 rounded-lg bg-warna-4 text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="staticModalEdit">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="w-full flex items-start p-6 space-x-12">
                    {{-- form modal --}}
                    <div class="w-1/2 space-y-3">
                        <div>
                            <h2 class="text-xs font-bold text-caption">AKUN USER ADMIN</h2>
                        </div>
                        <div>
                            <input type="hidden" name="idUser" id="idUserEdit">
                            <input type="hidden" name="level" value="manajer">
                            <label for="usernameEdit" class="block text-caption text-sm mb-2">Username</label>
                            <input type="text" id="usernameEdit" name="username" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                        <div class="flex justify-center items-center space-x-2">
                            <div class="w-full">
                                <label class="text-caption text-sm">Gambar Sekarang</label>
                                <label class="block text-caption mt-2">
                                    <div id="profilEdit" style="background-image: url('/img/profil.jpg'); " class="bg-fill rounded-md w-full h-48 flex justify-center items-center relative bg-cover bg-center" ></div>
                                    <input type="hidden" name="profilSekarang" id="gambarEditSkg">
                                </label>
                            </div>
                            <div class="w-full">
                                <label class="text-caption text-sm">Gambar</label>
                                <label for="profilEdits" class="block text-caption mt-2">
                                    <div class="bg-fill rounded-md w-full h-48 flex flex-col justify-center items-center py-7 relative cursor-pointer">
                                        <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M76.8492 58.344L64.6394 29.835C60.5045 20.163 52.8978 19.773 47.7876 28.977L40.4149 42.276C36.6701 49.023 29.6875 49.608 24.8504 43.563L23.9922 42.471C18.96 36.153 11.8604 36.933 8.23257 44.148L1.52304 57.603C-3.19704 66.963 3.62952 78 14.0839 78H63.8593C74.0016 78 80.8281 67.665 76.8492 58.344ZM19.4671 23.4C22.5709 23.4 25.5475 22.1673 27.7422 19.9732C29.9369 17.779 31.1698 14.803 31.1698 11.7C31.1698 8.59697 29.9369 5.62103 27.7422 3.42685C25.5475 1.23268 22.5709 0 19.4671 0C16.3634 0 13.3868 1.23268 11.1921 3.42685C8.99742 5.62103 7.76446 8.59697 7.76446 11.7C7.76446 14.803 8.99742 17.779 11.1921 19.9732C13.3868 22.1673 16.3634 23.4 19.4671 23.4Z" fill="#BDCCD4" fill-opacity="0.5"/>
                                        </svg>
                                        <span id="fileNameEdit" class="mt-4"></span>
                                    </div>
                                </label>
                                <input type="file" name="gambar" id="profilEdits" class="invisible absolute top-0">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 space-y-3">
                        <div>
                            <h2 class="text-xs font-bold text-caption">BIODATA USER ADMIN</h2>
                        </div>
                        <div>
                            <label for="namalengkapEdit" class="block text-caption text-sm mb-2">Nama Lengkap</label>
                            <input type="text" id="namalengkapEdit" name="nama" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                        <div>
                            <label for="hpEdit" class="block text-caption text-sm mb-2">No Handphone</label>
                            <input type="text" id="hpEdit" name="no_hp" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                        <div>
                            <label for="alamatEdit" class="block text-caption text-sm mb-2">Alamat</label>
                            <input type="text" id="alamatEdit" name="alamat" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal footer -->
            <div class="flex items-center justify-end w-full px-12 py-6 space-x-2 rounded-md bg-warna-4">
                <button data-modal-toggle="staticModalEdit" type="button" class="text-primary bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Batal</button>
                <button data-modal-toggle="staticModalEdit" type="submit" class="text-white bg-componen hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit User</button>
            </div>
            {{-- end modal footer --}}
        </form>
    </div>
</div>
{{-- end modal edit user --}}


@endsection
