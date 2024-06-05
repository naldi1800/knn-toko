<x-main-layout>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Pegawai') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-4">
            <a href="{{route('employees.create')}}" class="btn btn-success"> Tambah Pegawai</a>
            <a href="{{route('employees.phk')}}" class="btn btn-info"> Lihat Pegawai Dipecat</a>
        </div>
        <div class="col-12">
            &nbsp;
        </div>

        <div class="col-12 ">
            <table class=" table-responsive table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">NO HP</th>
                        <th scope="col">Aktif</th>
                        <th scope="col">Action</th>
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
                                <td class="text-start">{{$d->nama}}</td>
                                <td>{{$d->email}}</td>
                                <td>{{$d->nohp}}</td>
                                <td>{{$d->still_working ? "Sedang bekerja" : "Tidak aktif" }}</td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-primary " href="{{route('employees.edit', ['id' => $d->id])}}"
                                        role="button">Edit</a>
                                    &nbsp;&nbsp;
                                    @if($d->still_working)
                                        <form action="{{route('employees.pecat', ['id' => $d->id, 'state' => '0'])}}" class=""
                                            method="post">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">PHK</button>
                                        </form>
                                    @else
                                        <form action="{{route('employees.pecat', ['id' => $d->id, 'state' => '1'])}}" class=""
                                            method="post">
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Batalkan PHK</button>
                                        </form>
                                    @endif
                                    &nbsp;&nbsp;
                                    @if(empty(App\Models\User::where('email', $d->email)->first()))
                                        <form action="{{route('employees.account', ['id' => $d->id])}}" class="" method="post">
                                            @csrf
                                            <button class="btn btn-secondary" type="submit">Create Akun</button>
                                        </form>
                                    @else
                                        <form action="{{route('employees.defaultpassword', ['id' => $d->id])}}" class=""
                                            method="post">
                                            @csrf
                                            <button class="btn btn-secondary" type="submit">Default Password</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</x-main-layout>