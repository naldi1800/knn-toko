<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Tambah Pegawai') }}
        </h2>
    </x-slot>
    <div>

        <h6><span class="text-danger">*</span> wajib diisi</h6>
        <form class="row g-3 needs-validation" action="{{route('employees.save')}}" method="POST" novalidate>
            @csrf
            <div class="col-md-12">
                <label for="name" class="form-label">Nama Pegawai<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback">
                    Masukan nama pegawai!!!
                </div>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">
                    Masukan email!!!
                </div>
            </div>
            <div class="col-md-6">
                <label for="nohp" class="form-label">No Hp<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nohp" name="nohp" required>
                <div class="invalid-feedback">
                    Masukan NO HP!!!
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</x-main-layout>