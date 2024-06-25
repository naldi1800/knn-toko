<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Reset Password') }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h6><span class="text-danger">*</span> wajib diisi</h6>
    <div class="row">
        <form class="col-6 g-3 needs-validation" action="{{route('resetpassadmin.reset')}}" method="POST" novalidate>
            @csrf
            <div class="col-md-12">
                <label for="current_password" class="form-label">Password Sebelumnya<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="current_password" name="current_password" required>
                <div class="invalid-feedback">
                    Masukan Password Sebelumnya!!!
                </div>
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Password Baru<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                    Masukan Password Baru!!!
                </div>
            </div>
            <div class="col-md-12">
                <label for="repassword" class="form-label">Password baru ulang<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="repassword" name="repassword" required>
                <div class="invalid-feedback">
                    Masukan Password baru ulang!!!
                </div>
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</x-main-layout>