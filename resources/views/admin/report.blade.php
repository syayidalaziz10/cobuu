@extends('admin.template.main')
@include('admin.template.sidebar')

@section('content')
<div class="py-14 px-6">
    <div class="mb-10">
        <h1 class="text-caption text-2xl font-bold m">PENJUALAN BULANAN</h1>
    </div>

    <div class="flex justify-center h-24 mb-4 items-center w-full bg-fill rounded-xl">
        <form class="w-full flex justify-around items-center">
            <div>
                <input class="border border-primary py-1 px-20 rounded-3xl text-caption font-bold" type="date" name="q" value="{{ $q }}">
            </div>
            <div class="text-3xl font-bold text-primary">
                -
            </div>
            <div>
                <input class="border border-primary py-1 px-20 rounded-3xl text-caption font-bold" type="date" name="r" value="{{ $r }}">
            </div>
            <div>
                <button class="bg-primary py-2 px-20 rounded-3xl text-fill font-bold">Cari Laporan</button>
            </div>
        </form>
    </div>

    <div class="flex justify-center items-center h-screen w-full bg-fill rounded-2xl">
        <div class="h-full w-3/5 py-10 px-20">
            <div class="w-full mb-6">
                <div class="flex space-x-7 mb-7">
                    <div class="text-fill bg-primary w-1/2 h-40 rounded-xl px-8 py-6">
                        <p>Total Menu Yang Terjual</p>
                        @if($dataDetail != [])<h1 class="font-bold mt-6 text-5xl">{{ $banyakMenu }}</h1>@else<h1 class="text-componen font-bold text-2xl">Tidak ada Pemesanan</h1>@endif
                    </div>
                    <div class="text-fill bg-primary w-1/2 h-40 rounded-xl px-8 py-6">
                        <p>Jumlah Menu Yang Terjual</p>
                        @if($dataDetail != [])<h1 class="font-bold mt-6 text-5xl">{{ $jumlahMenu}}</h1>@else<h1 class="text-componen font-bold text-2xl">Tidak ada Pemesanan</h1>@endif
                    </div>
                </div>
                <div class="text-fill bg-primary w-full h-40 rounded-xl px-8 py-6">
                    <p>Total Pemesanan Yang dibuat</p>
                    @if($dataDetail != [])<h1 class="font-bold mt-6 text-5xl"> {{$totalPesanan}} </h1>@else<h1 class="text-componen font-bold text-2xl">Tidak ada Pemesanan</h1>@endif
                </div>
            </div>
            <div class="w-full space-y-4">
                <div class="text-primary font-bold">
                    MENU YANG TERJUAL
                </div>
                {{-- div item menu --}}
                <div class="h-80 overflow-auto space-y-2 flex flex-col mb-10 pr-4">
                    @if($dataDetail != [])
                    @foreach($dataDetail as $detail)
                    <div class="flex w-full h-28 bg-primary rounded-xl p-4 justify-between">
                        <div class="flex items-center space-x-10">
                            <div class="w-20 h-20 rounded-xl bg-cover bg-center" style="background-image: url('{{ asset('storage/'. $detail["menu"][0]->gambar) }}')"></div>
                            <div class="text-fill">
                                <h1 class="font-bold">{{ $detail["menu"][0]->nama_menu }}</h1>
                                <p class="font-light">Rp. {{ $detail["menu"][0]->harga }}</p>
                            </div>
                        </div>
                        <div>
                            <div class="w-20 h-20 rounded-xl bg-fill text-caption font-bold text-4xl flex items-center justify-center">{{$detail["jmlMenu"]}}</div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-componen font-bold text-2xl">Tidak ada Pemesanan</p>
                    @endif
                </div>
                {{-- end div items menu --}}
            </div>
        </div>

        <div class="h-full w-2/5 rounded-l-2xl py-8 px-12">
            <div class="overflow-auto py-6 px-8 bg-primary rounded-2xl space-y-6 h-5/6 mb-12">
                <h1 class="font-bold text-fill">DETAIL PENJUALAN</h1>

                {{-- div detail menu dan harga --}}
                @foreach($dataDetail as $detail)
                <div class="flex items-center justify-between">
                    <div class="text-fill">
                        <h1 class="font-bold">{{ $detail["menu"][0]->nama_menu }}</h1>
                        <p class="font-light">Rp. {{ $detail["menu"][0]->harga }} x {{ $detail["jmlMenu"] }}</p>
                    </div>
                    <div>
                        <h1 class="text-fill">Rp. {{ $detail["menu"][0]->harga*$detail["jmlMenu"] }}</h1>
                    </div>
                </div>
                @endforeach
                {{-- end div detail menu dan harga --}}
                
            </div>
            <div>
                <p class="text-primary">PENDAPATAN BULANAN</p>
                <h1 class="font-bold text-4xl text-warna-3">RP. {{ $totalPendapatan }}</h1>
            </div>
        </div>

    </div>

    <div class="w-full">
        <div class="text-2xl font-bold text-primary mt-20 mb-8">
            DETAIL PEMESANAN
        </div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-primary uppercase bg-secondary">
                <tr>
                    <th class="p-6 rounded-l-xl">No</th>
                    <th class="p-6">ID Pemesanan</th>
                    <th class="p-6">Nama Kasir</th>
                    <th class="p-6">Tanggal Pemesanan</th>
                    <th class="p-6 rounded-r-xl">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $j=1; ?>
                @foreach($pemesanan as $ps)
                <tr class="bg-fill">
                    <th class="p-6 font-medium text-gray-900 whitespace-nowrap">{{$j}}</th>
                    <td class="p-6 ">{{$ps->id_pemesanan}}</td>
                    <td class="p-6">{{$ps->nama}}</td>
                    <td class="p-6">{{$ps->tanggal_pemesanan}}</td>
                    <td class="p-6">
                        <a href="{{ route('admin.reportPemesanan', ['pemesanan' => $ps->id_pemesanan]) }}" class="font-medium uppercase cursor-pointer text-blue-600 hover:underline">Lihat Detail</a>
                    </td>
                </tr>
                <?php $j++; ?>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection