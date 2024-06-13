<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Data Latih KNN') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-4">
            <a href="{{route('items')}}" class="btn btn-secondary">back</a>
            <a href="{{route('items.knn')}}" class="btn btn-info">Rekomendasi KNN</a>
        </div>
        <div class="col-12">
            &nbsp;
        </div>

        <div class="col-12 ">
            <table class=" table-responsive table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Sisa Stok</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
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
                                <td>{{(is_null($d->item->kode) ? '-' : $d->item->kode)}}</td>
                                <td class="text-start">{{$d->item->name}}</td>
                                <td>{{is_null($d->item->merek)? '-' : $d->item->merek}}</td>
                                <td>{{$d->item->stok}}</td>
                                <td>{{$d->jumlah}}</td>
                                <td class="text-end">{{rupiah($d->harga)}}</td>
                                <td class="text-end">{{rupiah($d->total)}}</td>
                               
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-main-layout>