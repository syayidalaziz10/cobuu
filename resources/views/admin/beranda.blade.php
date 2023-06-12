@extends('admin.template.main')
@include('admin.template.sidebar')

@section('content')
    <div class="py-14">
        <div class="mb-10">
            <h1 class="text-caption font-bold text-2xl">Dashboard</h1>
        </div>
        <div class="w-full h-96 bg-primary text-caption flex items-center rounded-xl justify-around mb-10">
            <div class="space-y-4">
                <p class="text-sm">SELAMAT DATANG</p>
                <h1 class="font-bold text-3xl">Kelola penjualan Toko Surya Baru <br> dengan lebih mudah</h1>
                <p>Anda dapat mengelolah dan mengakses fitur-fitur penting <br> pada portal admin!</p>
            </div>
            <div>
                <img src="img/dashboard.png" alt="dashboard" style="width: 30rem">
            </div>
        </div>
        <div class="flex items-center space-x-9 text-fill">
            <div class="bg-color-1 px-10 py-6 w-1/3 h-44 rounded-xl bg ">
                <p class="mb-4">Jumlah User Kasir</p>
                <h1 class="text-5xl font-bold">{{ $kasir }}</h1>
            </div>
            <div class="bg-color-2 px-10 py-6 w-1/3 rounded-xl h-44">
                <p class="mb-4">Jumlah User Admin</p>
                <h1 class="text-5xl font-bold">{{ $admin }}</h1>
            </div>
            <div class="bg-color-3 px-10 py-6 w-1/3 h-44 rounded-xl">
                <p class="mb-4">Jumlah Produk Toko</p>
                <h1 class="text-5xl font-bold">{{ $menu }}</h1>
            </div>
        </div>
    </div>
@endsection