
@extends('kasir.template.main')
@include('kasir.template.sidebar')

@section('content')
    

<div class="w-3/4 bg-content" onload="alert('Pesanan ditambahkan');">
    <div class="w-full h-screen py-10 px-20 rounded-r-3xl flex flex-col items-start">
        {{-- <h1 class="text-caption text-2xl font-semibold">Daftar Produk</h1> --}}
        <form action="" class="flex w-full">
            <div class="flex w-full gap-4">
                <div class="relative w-2/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" name="cari" value="{{ $cari }}" placeholder="Cari semua produk disini ... " class="w-full py-3.5 text-sm px-14 bg-fill rounded-lg outline-1 outline-primary">
                </div>
                <button type="submit" class="px-6 bg-primary rounded-lg text-sm font-semibold text-fill flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Cari
                </button>
            </div>
        </form>
        <div class="mt-10 overflow-y-auto w-full flex gap-5 items-start flex-wrap">
            {{-- daftar menu --}}
            <div class="flex flex-col gap-6 w-full py-4">
                <div class="flex justify-between">

                    @if (isset($cari))
                        <h1 class="uppercase text-primary text-xl font-bold">Hasil pencarian</h1>
                        <div>
                            <a href="javascript:void(0)" onclick="history.back()" class="text-caption border border-primary py-2 text-base px-10 rounded-3xl bg-fill">Kembali</a>
                        </div>
                    @else
                        <h1 class="uppercase text-primary text-xl font-bold">Produk</h1>
                    @endif
                </div>
            </div>
            @foreach($menu as $mn)
            <button id="{{$mn->id_menu}}" data-idmenu="{{$mn->id_menu}}" data-namamenu='{{$mn->nama_menu}}' data-hargamenu="Rp. {{$mn->harga}}" data-gambar = '{{ asset('storage/'. $mn->gambar) }}' data-hg={{$mn->harga}}  onclick="cobu(this);" class="btn w-80 h-40 p-4 rounded-xl flex gap-6 items-start">
                <div class="rounded-xl h-full w-1/2 bg-cover bg-center bg-secondary" style="background-image: url('{{ asset('storage/'. $mn->gambar) }}')"></div>
                <div class="h-full flex flex-col items-start justify-between py-2">
                    <div>
                        <h1 class="font-semibold text-caption text-left">{{$mn->nama_menu}}</h1>
                    </div>
                    <div>
                        <p class="font-medium text-lg text-primary text-left">Rp. {{$mn->harga}}</p>
                        <p class=" text-caption text-left opacity-60 text-base">Stok: {{$mn->stok}}</p>
                    </div>
                </div>
            </button>
            {{-- end daftar menu --}}
            @endforeach
        </div>
    </div>
</div>
{{-- end list menu --}}

{{-- detail pesanan --}}
<div class="bg-fill w-1/4 h-screen flex flex-col justify-between  overflow-auto scrollbar-hide">
    <div>
        <div class="sticky top-0 py-10 px-12">
            <h1 class="text-2xl text-caption font-semibold tracking-wide">Detail Pesanan</h1>
        </div>
        <div id='listmenu' class="min-h-screen flex flex-col gap-5 px-10">
        </div>
    </div>
    {{-- total harga --}}
    <div class="pb-10 px-8 pt-4 justify-between sticky bottom-0  text-caption w-full">
        <div>
            <div class="px-4 py-10 rounded-xl space-y-4">
                <div class="flex justify-between items-center">
                    <p class="font-light">Uang</p>
                    <div class="flex items-center gap-3">
                        <p class="font-semibold text-caption text-lg" > Rp. </p>
                        <input id="uang" type="number" class="text-lg font-semibold text-caption w-40 p-2 rounded-md border-2 border-primary">
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-light">Kembali</p>
                    <div class="flex items-center gap-3">
                        <p class="font-semibold text-caption text-lg" > Rp. </p>
                        <input id="kembalian" type="number" readonly class="text-lg font-semibold text-caption w-40 p-2 rounded-md border-2 border-primary">
                    </div>
                </div>
            </div>
            <div class="mb-8 bg-secondary px-4 py-6 rounded-xl">
                <p class="font-light">Total Harga</p>
                <h1 id="totalhg" class="text-2xl font-semibold text-caption">Rp. 0</h1>
            </div>
        </div>
        <div class="w-full">
            <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input id="valMenu" type="hidden" name="nama_menu">
                <input id="valJml" type="hidden" name="jumlah">
                <button id="submitBtn" type="submit" onclick="tmbh();" class="bg-primary text-caption text-xl py-4 w-full rounded-xl font-semibold">Submit</button>
            </form>
        </div>
    </div>
    
    {{-- end total harga --}}
</div>
{{-- end detail pesanan --}}


@endsection