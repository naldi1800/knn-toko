<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-4">
            <a href="{{route('items.create')}}" class="btn btn-success"> Tambah barang</a>
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
                        <th scope="col">Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr class="text-center">
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{(is_null($d->kode) ? 'Kode tidak tersedia' : $d->kode)}}</td>
                            <td class="text-start">{{$d->name}}</td>
                            <td>{{$d->merek}}</td>
                            <td class="text-end">{{rupiah($d->harga)}}</td>
                            <td>{{$d->diskon}}</td>
                            <td>{{$d->stok}}</td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-primary " href="{{route('items.edit', ['id' => $d->id])}}"
                                    role="button">Edit</a>
                                &nbsp;&nbsp;
                                <form action="{{route('items.delete', ['id' => $d->id])}}" class="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>&nbsp;&nbsp;
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#editStock{{$d->id}}">
                                    Edit Stock
                                </button>
                                <div class="modal fade" id="editStock{{$d->id}}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStock{{$d->id}}Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editStock{{$d->id}}Label">Edit stock barang
                                                    "{{$d->name}}"</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('items.add', ['id' => $d->id])}}" method="post">
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
                </tbody>
            </table>
        </div>
    </div>

</x-main-layout>