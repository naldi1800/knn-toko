<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Result KNN') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-4">
            <a href="{{route('items')}}" class="btn btn-secondary">back</a>
            <!-- <a href="{{route('items.knn')}}" class="btn btn-info">Rekomendasi KNN</a> -->
        </div>
        <div class="col-12">
            &nbsp;
        </div>

        <div class="col-12 ">
            <table class=" table-responsive table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center align-middle">
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Sisa Stok</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Barang Terjual</th>
                        <th scope="col">Total saat ini (Harga * TBT)</th>
                        <th scope="col">Saran penambahan stock</th>
                        <th scope="col">Total pendapatan masa depan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($datas[0]))
                        <tr class="text-center">
                            <th scope="col" colspan="11">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($datas as $d)
                            <?php        $rekStock = (int) ($d['total_masa_depan'] / $d['harga'] - $d['item']->stok); ?>
                            <tr class="text-center">
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{(is_null($d['item']->kode) ? '-' : $d['item']->kode)}}</td>
                                <td class="text-start">{{$d['item']->name}}</td>
                                <td>{{is_null($d['item']->merek) ? '-' : $d['item']->merek}}</td>
                                <td>{{$d['item']->stok}}</td>
                                <td class="text-end">{{rupiah($d['harga'])}}</td>
                                <td>{{$d['jumlah']}}</td>
                                <td class="text-end">{{rupiah($d['total'])}}</td>
                                <td>{{($rekStock <= 0)? 0 : $rekStock}}</td>
                                <td class="text-end">{{rupiah($d['total_masa_depan'])}}</td>
                                <td>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editStock{{$d['item']->id}}">
                                        Edit Stock
                                    </button>
                                    <div class="modal fade" id="editStock{{$d['item']->id}}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="editStock{{$d['item']->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStock{{$d['item']->id}}Label">Edit stock
                                                        barang
                                                        "{{$d['item']->name}}"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('items.add', ['id' => $d['item']->id])}}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    <div class="modal-body">
                                                        <input type="number" min="1" class="form-control" name="stock_add"
                                                            id="stock_add"
                                                            placeholder="Masukkan jumlah stock yang ingin ditambah" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-main-layout>