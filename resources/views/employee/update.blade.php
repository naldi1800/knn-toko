<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Tambah Barang') }}
        </h2>
    </x-slot>
    <div>
        
        <h6><span class="text-danger">*</span> wajib diisi</h6>
        <form class="row g-3 needs-validation" action="{{route('employees.update', ['id' => $d->id])}}" method="POST" novalidate>
            @csrf
            <div class="col-md-12">
                <label for="name" class="form-label">Nama Barang<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{$d->name}}" id="name" name="name" required>
                <div class="invalid-feedback">
                    Masukan nama barang!!!
                </div>
            </div>
            <div class="col-md-6">
                <label for="kode" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" value="{{$d->kode}}" id="kode" name="kode">
                <div class="invalid-feedback">
                    Masukan kode barang!!!
                </div>
            </div>
            <div class="col-md-6">
                <label for="merek" class="form-label">Merek Barang<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{$d->merek}}" id="merek" name="merek" required>
                <div class="invalid-feedback">
                    Masukan merek barang!!!
                </div>
            </div>
            <div class="col-md-6">
                <label for="harga" class="form-label">Harga Barang<span class="text-danger">*</span></label>
                <input type="number" min="1000" value="{{$d->harga}}" class="form-control" id="harga" name="harga" required>
                <div class="invalid-feedback">
                    Masukan harga barang!!! Minimal Rp 1.000
                </div>
            </div>
            <div class="col-md-3">
                <label for="diskon" class="form-label">Diskon<span class="text-danger">*</span></label>
                <input type="number" max="100" min="0" value="{{$d->diskon}}" class="form-control" id="diskon" name="diskon" required>
                <div class="invalid-feedback">
                    Masukan diskon!!!
                </div>
            </div>
            <div class="col-md-3">
                <label for="stok" class="form-label">Stock<span class="text-danger">*</span></label>
                <input type="number" class="form-control" value="{{$d->stok}}" id="stok" name="stok" required>
                <div class="invalid-feedback">
                    Masukan stok barang!!!
                </div>
            </div>


            <div class="col-12">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
</x-main-layout>