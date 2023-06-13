@extends('admin.template.main')
@include('admin.template.sidebar')

@section('content')
<?php $i=1; ?>
{{-- main menu --}}
{{-- <div class="flex w-full justify-center">
    <input type="text" placeholder="Cari Menu" class="text-white w-full rounded-2xl my-12 py-3 px-16 bg-warna-2 text-secondary text-md">
</div> --}}
{{-- start main menu --}}
<div class="w-full bg-fill p-10 my-14 rounded-xl">
    <div class="flex mt-5 justify-between w-full items-center">
        <h1 class="text-caption text-2xl font-bold">Manajemen Produk</h1>
        <button type="button" data-modal-toggle="staticModal" class="py-3 px-8 bg-primary rounded-md font-semibold text-sm text-fill">Tambah Produk</button>
    </div>
    <div class="my-10">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-primary uppercase bg-secondary">
                <tr>
                    <th scope="col" class="p-6 rounded-l-xl">
                        No
                    </th>
                    <th scope="col" class="p-6">
                        Nama PRODUK
                    </th>
                    <th scope="col" class="p-6">
                        Kategori Produk
                    </th>
                    <th scope="col" class="p-6">
                        Harga
                    </th>
                    <th scope="col" class="p-6">
                        Stok
                    </th>
                    <th scope="col" class="p-6 rounded-r-xl">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $mn)
                    <tr class="bg-fill">
                        <th scope="row" class="p-6 font-medium text-gray-900 whitespace-nowrap">
                            {{$i}}
                        </th>
                        <td class="p-6">
                            {{$mn->nama_menu}}
                        {{-- </td> --}}
                        <td class="p-6">
                            {{$mn->nama_kategori}}
                        </td>
                        <td class="p-6">
                            {{$mn->harga}}
                        </td>
                        <td class="p-6">
                            {{$mn->stok}}
                        </td>
                        <td class="p-6">
                            <a class="font-medium mr-2 uppercase cursor-pointer text-blue-600 hover:underline" data-modal-toggle="staticModalEdit" onclick="edtMdl(this);" 
                            data-idMenu="{{$mn->id_menu}}" data-namaMenu="{{$mn->nama_menu}}" data-harga={{$mn->harga}} data-stok={{$mn->stok}} data-idKategori="{{$mn->id_kategori}}" data-gambar="{{asset('storage/'.$mn->gambar)}}" data-gambarSkg="{{$mn->gambar}}">
                            Edit
                            </a>
                            <form method="POST" class="inline" action="{{ route('menu.destroy', ['menu' => $mn->id_menu]) }}" onsubmit="return confirm('Delete?')">
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

{{-- modal tambah produk --}}
<div id="staticModal" data-modal-backdrop="static" aria-label="hidden" tabindex="-1" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-lg h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative rounded-xl shadow bg-content">
            <!-- Modal header -->
            <div class="p-6">
                <div class="flex justify-between items-start p-4 rounded-xl">
                    <h3 class="text-xl font-bold text-caption">
                        TAMBAH PRODUK
                    </h3>
                    <button type="button" class="text-componen hover:bg-gray-200 hover:text-gray-900 rounded-lg bg-warna-4 text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="staticModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- form modal --}}
                        @csrf
                        <div>
                            <label for="namamenu" class="block text-caption text-sm mb-2">Nama Menu</label>
                            <input name="nama_menu" type="text" id="namamenu" class="w-full bg-fill py-2 px-6 mb-2 rounded-md text-caption">
                            
                        </div>
                        <div>
                            <label for="harga" class="block text-caption text-sm mb-2">Harga</label>
                            <input name="harga" type="text" id="harga" class="w-full bg-fill py-2 px-6 mb-2 rounded-md text-caption">
                        </div>
                        <div>
                            <label for="stok" class="block text-caption text-sm mb-2">Stok</label>
                            <input name="stok" type="text" id="stok" class="w-full bg-fill py-2 px-6 mb-2 rounded-md text-caption">
                        </div>
                        <div>
                            <label for="kategori" class="block text-caption text-sm mb-2">Kategori</label>
                            <select name="id_kategori" id="kategori" class="w-full bg-fill py-2 px-6 mb-2 rounded-md text-caption">
                                @foreach ($kategori as $kategori)
                                    <option value="{{$kategori->id_kategori  }}">{{$kategori->nama_kategori }}</option>
                                @endforeach
                                ?>
                            </select>
                        </div>
                        <div>
                            <label class="text-caption text-sm">Gambar</label>
                            <label for="profil" class="block text-caption mt-2">
                                <div class="bg-fill rounded-md w-full flex flex-col justify-center items-center py-7 relative cursor-pointer">
                                    <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M76.8492 58.344L64.6394 29.835C60.5045 20.163 52.8978 19.773 47.7876 28.977L40.4149 42.276C36.6701 49.023 29.6875 49.608 24.8504 43.563L23.9922 42.471C18.96 36.153 11.8604 36.933 8.23257 44.148L1.52304 57.603C-3.19704 66.963 3.62952 78 14.0839 78H63.8593C74.0016 78 80.8281 67.665 76.8492 58.344ZM19.4671 23.4C22.5709 23.4 25.5475 22.1673 27.7422 19.9732C29.9369 17.779 31.1698 14.803 31.1698 11.7C31.1698 8.59697 29.9369 5.62103 27.7422 3.42685C25.5475 1.23268 22.5709 0 19.4671 0C16.3634 0 13.3868 1.23268 11.1921 3.42685C8.99742 5.62103 7.76446 8.59697 7.76446 11.7C7.76446 14.803 8.99742 17.779 11.1921 19.9732C13.3868 22.1673 16.3634 23.4 19.4671 23.4Z" fill="#BDCCD4" fill-opacity="0.5"/>
                                    </svg>
                                    <span id="fileName" class="mt-4"></span>
                                    <input name="gambar" type="file" id="profil" class="invisible absolute top-0">
                                </div>
                            </label>
                        </div>
                </div>
            </div>
            <div>
                <!-- Modal footer -->
                    <div class="flex items-center justify-end w-full px-12 py-6 space-x-2 rounded-md bg-warna-4">
                        <button data-modal-toggle="staticModal" type="button" class="text-primary bg-fill rounded-md border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">Batal</button>
                        <button data-modal-toggle="staticModal" type="submit" class="text-white bg-primary font-medium rounded-md text-sm px-5 py-2.5 text-center">Tambah Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal tambah produk --}}

{{-- modal edit produk --}}
<div id="staticModalEdit" data-modal-backdrop="static" tabindex="-1" aria-label="hidden" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <form action="{{ route('menu.update') }}"  method="POST" enctype="multipart/form-data" class="relative w-full max-w-lg h-full md:h-auto">
        @csrf
        {{-- @method('PUT') --}}
        <!-- Modal content -->
        <div class="relative rounded-xl shadow bg-content">
            <!-- Modal header -->
            <div class="p-6">
                <div class="flex justify-between items-start p-4 rounded-xl">
                    <h3 class="text-xl font-bold text-caption">
                        EDIT MENU
                    </h3>
                    <button type="button" class="text-componen hover:bg-gray-200 hover:text-gray-900 rounded-lg bg-warna-4 text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="staticModalEdit">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    {{-- form modal --}}
                    <div>
                        <input type="hidden" name="id_menu" id="idMenuEdit">
                        <label for="namaMenuEdit" class="block text-caption text-sm mb-2">Nama Menu</label>
                        <input type="text" id="namaMenuEdit" name="nama_menu" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                        
                    </div>
                    <div>
                        <label for="hargaEdit" class="block text-caption text-sm mb-2">Harga</label>
                        <input type="text" id="hargaEdit" name="harga" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                    </div>
                    <div>
                        <label for="stokEdit" class="block text-caption text-sm mb-2">Stok</label>
                        <input type="text" id="stokEdit" name="stok" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                    </div>
                    {{-- <div>
                        <label for="username" class="block text-caption text-sm mb-2">Kategori</label>
                        <select name="kategori" id="kategori" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div> --}}
                    <div class="flex justify-center items-center space-x-12">
                        <div class="w-full">
                            <label class="text-caption text-sm">Gambar Sekarang</label>
                            <label class="block text-caption mt-2">
                                <div id="gambarEdit" style="background-image: url('/img/profil.jpg'); " class="bg-fill rounded-md w-full h-32 flex justify-center items-center relative bg-cover bg-center" >
                                </div>
                                <input type="hidden" name="oldImage" id="gambarSedit">
                            </label>
                        </div>
                        <div class="w-full">
                            <label class="text-caption text-sm">Gambar</label>
                            <label for="profilEdits" class="block text-caption mt-2">
                                <div class="bg-fill rounded-md w-full flex flex-col justify-center items-center py-7 relative cursor-pointer">
                                    <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M76.8492 58.344L64.6394 29.835C60.5045 20.163 52.8978 19.773 47.7876 28.977L40.4149 42.276C36.6701 49.023 29.6875 49.608 24.8504 43.563L23.9922 42.471C18.96 36.153 11.8604 36.933 8.23257 44.148L1.52304 57.603C-3.19704 66.963 3.62952 78 14.0839 78H63.8593C74.0016 78 80.8281 67.665 76.8492 58.344ZM19.4671 23.4C22.5709 23.4 25.5475 22.1673 27.7422 19.9732C29.9369 17.779 31.1698 14.803 31.1698 11.7C31.1698 8.59697 29.9369 5.62103 27.7422 3.42685C25.5475 1.23268 22.5709 0 19.4671 0C16.3634 0 13.3868 1.23268 11.1921 3.42685C8.99742 5.62103 7.76446 8.59697 7.76446 11.7C7.76446 14.803 8.99742 17.779 11.1921 19.9732C13.3868 22.1673 16.3634 23.4 19.4671 23.4Z" fill="#BDCCD4" fill-opacity="0.5"/>
                                    </svg>
                                    <span id="fileNameEdit" class="mt-4"></span>
                                    <input type="file" name="gambar" id="profilEdits" class="invisible absolute top-0">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal footer -->
            <div class="flex items-center justify-end w-full px-12 py-6 space-x-2 rounded-md bg-warna-4">
                <button data-modal-toggle="staticModalEdit" type="button" class="text-primary bg-fill rounded-md border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">Batal</button>
                <button data-modal-toggle="staticModalEdit" type="submit" class="text-white bg-primary font-medium rounded-md text-sm px-5 py-2.5 text-center">Edit Menu</button>
            </div>
            {{-- end modal footer --}}
        </div>
    </form>
</div>
{{-- end modal edit user --}}

<script>
    let idMenuObj      = document.getElementById('idMenuEdit');
    let namaMenuObj    = document.getElementById('namaMenuEdit');
    let hargaObj       = document.getElementById('hargaEdit');
    let idKategoriObj  = document.getElementById('kategoriEdit');
    let stokObj  = document.getElementById('stokEdit');
    let gambarObj      = document.getElementById('gambarEdit');
    let gambarSObj     = document.getElementById('gambarSedit');
    let formSbm        = document.getElementById('formSbm');

    function edtMdl(obj)
    {
        console.log(obj);
        //obj
        const idMenu     = obj.getAttribute("data-idMenu");
        const namaMenu   = obj.getAttribute("data-namaMenu");
        const harga      = obj.getAttribute("data-harga");
        const idKategori = obj.getAttribute("data-idKategori");
        const stok = obj.getAttribute("data-stok");
        const gambar     = obj.getAttribute("data-gambar");
        const gambarS    = obj.getAttribute("data-gambarSkg");
        formSbm.action   = "http://localhost:8000/menu/"+String(idMenu);


        idMenuObj.value = idMenu;
        namaMenuObj.value=namaMenu;
        hargaObj.value = harga;
        stokObj.value = stok;
        gambarSObj.value = gambarS;

        // idKategoriObj =
        gambarObj.style.background      = `url('${gambar}') top center`;
        gambarObj.style.backgroundSize  = 'cover';
        
    }

</script>

@endsection