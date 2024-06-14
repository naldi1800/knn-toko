<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <div class="row">

        <div class="col-12 ">
            <table class=" table-responsive table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        <th scope="col">Harga Total</th>
                        <th scope="col">Pegawai</th>
                        <th scope="col">Tanggal Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($datas->first()))
                        <tr class="text-center">
                            <th scope="col" colspan="6">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($datas as $d)
                            <tr class="text-center">
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{(is_null($d['item']->kode) ? 'Kode tidak tersedia' : $d['item']->kode)}}</td>
                                <td class="text-start">{{$d['item']->name}}</td>
                                <td>{{is_null($d['item']->merek) ? '-' : $d['item']->merek}}</td>
                                <td class="text-end">{{rupiah($d->harga)}}</td>
                                <td>{{$d->jumlah}}</td>
                                <td>{{rupiah($d->harga * $d->jumlah)}}</td>
                                <td>{{$d['employee']->name}}</td>
                                <td>{{$d->created_at}}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-main-layout>