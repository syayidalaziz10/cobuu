@extends('admin.template.main')
@include('admin.template.sidebar')

@section('content')
<div class="py-14 px-6">

    <div class="mb-5">
        <a href="javascript:void(0)" onclick="history.back()" class="text-caption border border-primary py-2 text-base px-10 rounded-3xl bg-fill">Kembali</a>
    </div>
    <div class="mt-12 mb-8">
        <h1 class="text-caption text-2xl font-bold">DETAIL PEMESANAN</h1>
    </div>

    <div class="bg-fill w-full rounded-xl">
        <div class="p-10 space-y-4">
            {{-- div menu detail --}}
            <?php $total=0; ?>
            @foreach($details as $detail)
            <div class="flex w-full h-28 bg-primary rounded-xl p-4 justify-between items-center pr-16">
                <div class="flex items-center space-x-10">
                    <div class="w-20 h-20 rounded-xl bg-cover bg-center" style="background-image: url('{{ asset('storage/'. $detail->gambar) }}')"></div>
                    <div class="text-secondary">
                        <h1 class="font-bold">{{ $detail->nama_menu }}</h1>
                        <p class="font-light">Rp. {{ $detail->harga }} x {{ $detail->jumlah }} </p>
                    </div>
                </div>
                <div>
                    <div class="text-fill font-bold text-xl">Rp. {{ $detail->harga*$detail->jumlah }}</div>
                </div>
            </div>
            <?php $total+=($detail->harga*$detail->jumlah); ?>
            @endforeach
            {{-- end div menu detail --}}
        </div>

        {{-- div total --}}
        <div class="w-full flex justify-between py-8 px-12 items-center">
            <div class="text-primary font-bold text-3xl">TOTAL</div>
            <div class="text-caption font-bold text-3xl">RP. {{ $total }}</div>
        </div>
        {{-- end div total --}}
        
    </div>

</div>

@endsection