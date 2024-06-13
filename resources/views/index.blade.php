<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="row col-12">
        <div class="col-3 mb-2 text-center">
            <div class="card border-primary ">
                <div class="card-header text-white bg-primary">
                    Total Barang
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tItem}}</h1>
                </div>
            </div>
        </div>
        <div class="col-3 mb-2 text-center">
            <div class="card border-secondary ">
                <div class="card-header text-white bg-secondary">
                    Total Stock
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tStock}}</h1>
                </div>
            </div>
        </div>
        <div class="col-3 mb-2 text-center">
            <div class="card border-primary ">
                <div class="card-header text-white bg-primary">
                    Total Pegawai
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tEmployee}}</h1>
                </div>
            </div>
        </div>
        <div class="col-3 mb-2 text-center">
            <div class="card border-secondary ">
                <div class="card-header text-white bg-secondary">
                    Total Pegawai Sedang Bekerja
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tEmployeeActiv}}</h1>
                </div>
            </div>
        </div>
        <!-- BARIS 2 -->
        <!-- <div class="col-3 mb-2 text-center">
            <div class="card border-secondary ">
                <div class="card-header text-white bg-secondary">
                    Total Penjualan Hari Ini
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tItem}}</h1>
                </div>
            </div>
        </div>
        <div class="col-3 mb-2 text-center">
            <div class="card border-primary ">
                <div class="card-header text-white bg-primary">
                    Total Penjualan Minggu Ini
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tStock}}</h1>
                </div>
            </div>
        </div>
        <div class="col-3 mb-2 text-center">
            <div class="card border-secondary ">
                <div class="card-header text-white bg-secondary">
                    Total Penjualan Bulan Ini   
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tEmployee}}</h1>
                </div>
            </div>
        </div>
        <div class="col-3 mb-2 text-center">
            <div class="card border-primary ">
                <div class="card-header text-white bg-primary" style="font-size: .95rem;">
                    Total Penjualan 3 Bulan Terakhir
                </div>
                <div class="card-body p-3 row">
                    <h1>{{$tEmployeeActiv}}</h1>
                </div>
            </div>
        </div> -->
    </div>
</x-main-layout>