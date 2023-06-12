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
        <h1 class="text-caption text-2xl font-bold">Kategori Produk</h1>
        <button type="button" data-modal-toggle="staticModal" class="py-3 px-8 bg-primary rounded-md font-semibold text-sm text-fill">Tambah Kategori</button>
    </div>
    <div class="my-10">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-primary uppercase bg-secondary">
                <tr>
                    <th scope="col" class="p-6 rounded-l-xl">
                        No
                    </th>
                    <th scope="col" class="p-6">
                        Nama Kategori
                    </th>
                    <th scope="col" class="p-6 rounded-r-xl">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $mn)
                    <tr class="bg-fill">
                        <th scope="row" class="p-6 font-medium text-gray-900 whitespace-nowrap">
                            {{$i}}
                        </th>
                        <td class="p-6">
                            {{$mn->nama_kategori}}
                        </td>
                        <td class="p-6">
                            <a class="font-medium mr-2 uppercase cursor-pointer text-blue-600 hover:underline" data-modal-toggle="staticModalEdit" onclick="edtKategori(this);" 
                            data-idKategori="{{$mn->id_kategori}}" data-namaKategori="{{$mn->nama_kategori}}">
                            Edit
                            </a>
                            <form method="POST" class="inline" action="{{ route('kategori.destroy', ['kategori' => $mn->id_kategori]) }}" onsubmit="return confirm('Delete?')">
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
                        TAMBAH KATEGORI
                    </h3>
                    <button type="button" class="text-componen hover:bg-gray-200 hover:text-gray-900 rounded-lg bg-warna-4 text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="staticModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- form modal --}}
                        @csrf
                        <div>
                            <label for="namakategori" class="block text-caption text-sm mb-2">Nama Kategori</label>
                            <input name="nama_kategori" type="text" id="namakategori" class="w-full bg-fill py-2 px-6 mb-2 rounded-md text-caption">
                        </div>
                </div>
            </div>
            <div>
                <!-- Modal footer -->
                    <div class="flex items-center justify-end w-full px-12 py-6 space-x-2 rounded-md bg-warna-4">
                        <button data-modal-toggle="staticModal" type="button" class="text-primary bg-fill rounded-md border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">Batal</button>
                        <button data-modal-toggle="staticModal" type="submit" class="text-white bg-primary font-medium rounded-md text-sm px-5 py-2.5 text-center">Tambah Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end modal tambah produk --}}

{{-- modal edit produk --}}
<div id="staticModalEdit" data-modal-backdrop="static" tabindex="-1" aria-label="hidden" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <form action="{{ route('kategori.update') }}" id="formSbm" method="POST" enctype="multipart/form-data" class="relative w-full max-w-lg h-full md:h-auto">
        @csrf
        @method('PUT')
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
                        <input type="hidden" name="id_kategori" id="idKategoriEdit">
                        <label for="namaKategori" class="block text-caption text-sm mb-2">Nama Kategori</label>
                        <input type="text" id="namaKategori" name="nama_kategori" class="w-full bg-fill py-2 px-6 rounded-md text-caption">
                    </div>
                </div>
            </div>
            <!-- modal footer -->
            <div class="flex items-center justify-end w-full px-12 py-6 space-x-2 rounded-md bg-warna-4">
                <button data-modal-toggle="staticModalEdit" type="button" class="text-primary bg-fill rounded-md border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">Batal</button>
                <button data-modal-toggle="staticModalEdit" type="submit" class="text-white bg-primary font-medium rounded-md text-sm px-5 py-2.5 text-center">Edit Kategori</button>
            </div>
            {{-- end modal footer --}}
        </div>
    </form>
</div>
{{-- end modal edit user --}}

<script>
    let idKategoriObj      = document.getElementById('idKategoriEdit');
    let namaKategoriObj    = document.getElementById('namaKategori');
    let formSbm        = document.getElementById('formSbm');

    function edtKategori(obj)
    {
        console.log(obj);
        //obj
        const idKategori     = obj.getAttribute("data-idKategori");
        const namaKategori  = obj.getAttribute("data-namaKategori");
        formSbm.action   = "http://localhost:8000/kategori/"+String(idKategori);


        idKategoriObj.value = idKategori;
        namaKategoriObj.value=namaKategori;
        
    }

</script>

@endsection