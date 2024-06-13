<x-employee-layout>
    <!-- <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Halaman Utama') }}
        </h2>
    </x-slot> -->
    <div class="row col-12">
        <div class="col-4 mb-2">
            <div class="card border-primary ">
                <div class="card-header text-white bg-primary">
                    Cari Barang
                </div>
                <div class="card-body p-3 row">
                    <form action="{{route('employee.getsearch')}}" method="post" class="row me-1">
                        @csrf
                        @method('post')
                        <div class="col-9">
                            <input type="text" class="form-control" name="search" id="search"
                                placeholder="Name or kode item" required>
                        </div>
                        <button type="submit" class="btn btn-primary col-3">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8 mb-2">
            @if (!empty($search))
                <div class="card border-primary ">
                    <div class="card-header text-white bg-primary">
                        Hasil Pencarian
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Diskon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($search as $s)
                                    <tr>
                                        <th scope="row">{{$loop->index + 1}}</th>
                                        <td>{{$s->kode}}</td>
                                        <td>{{$s->name}}</td>
                                        <td>{{rupiah($s->harga)}}</td>
                                        <td>{{$s->diskon}}</td>
                                        <td class="text-center">
                                            <a href="{{route('employee.keranjang', ['id' => $s->id])}}" class="none">
                                                <img src="{{asset('/image/icons/cart.png')}}" alt="cart" width="35"
                                                    height="35"></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-8">

            <div class="card border-primary mb-3">
                <div class="card-header text-white bg-primary">
                    Keranjang
                </div>
                @php
                    $totals = 0;
                    $ids = "";
                @endphp
                <div class="card-body table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <!-- <th scope="col">Diskon</th> -->
                                <th scope="col">Qyt</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($basket))
                                <td colspan="8" class="text-center">Belum ada barang</td>
                            @else
                                                    @foreach ($basket as $b)
                                                                            <tr>
                                                                                <th scope="row">{{$loop->index + 1}}</th>
                                                                                <td>{{$b->item->kode}}</td>
                                                                                <td>{{$b->item->name}}</td>
                                                                                <td>{{rupiah($b->harga)}}</td>
                                                                                <!-- <td>{{$b->diskon}}</td> -->
                                                                                <td>{{$b->jumlah}}</td>
                                                                                <td>{{rupiah($b->harga * $b->jumlah)}}</td>
                                                                                <td class="d-flex">
                                                                                    <a class="btn btn-info" href="{{route('employee.add', ['id' => $b->id])}}">+</a>

                                                                                    @if ($b->jumlah > 1)
                                                                                        <a class="btn btn-secondary ms-2"
                                                                                            href="{{route('employee.minus', ['id' => $b->id])}}">-</a>
                                                                                    @endif

                                                                                    <button type="button" class="btn ms-2 btn-danger" data-bs-toggle="modal"
                                                                                        data-bs-target="#deleteItem">X
                                                                                    </button>
                                                                                    <div class="modal fade" id="deleteItem" data-bs-backdrop="static"
                                                                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteItemLabel"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="deleteItemLabel">{{$b->item->name}}</h5>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                                        aria-label="Close"></button>
                                                                                                </div>
                                                                                                <form action="{{route('employee.delete', ['id' => $b->id])}}"
                                                                                                    method="post">
                                                                                                    @csrf
                                                                                                    @method('post')
                                                                                                    <div class="modal-body">
                                                                                                        <div class="mb-3">
                                                                                                            <label for="email" class="form-label text-start">Email
                                                                                                                address</label>
                                                                                                            <input type="email" class="form-control" name="email"
                                                                                                                id="email" aria-describedby="emailLabel">
                                                                                                            <div id="emailLabel" class="form-text">Kamu harus
                                                                                                                memasukan email Admin sebelum bisa menghapus item yang
                                                                                                                sudah di Keranjang</div>
                                                                                                        </div>
                                                                                                        <div class="mb-3">
                                                                                                            <label for="password" class="form-label">Password</label>
                                                                                                            <input type="password" class="form-control" name="password"
                                                                                                                id="password">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-secondary"
                                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                                        <button type="submit" class="btn btn-danger">delete</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                                $ids .= $b->id . ",";
                                                                                $totals += ($b->harga * $b->jumlah);

                                                                            @endphp
                                                    @endforeach 
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-4">
            <div class="card border-primary ">
                <div class="card-header text-white bg-primary">
                    Pembayaran
                </div>
                <div class="card-body text-dark row">
                    <h1 class="col-12 mb-5">{{rupiah($totals)}}</h1>
                    <form action="{{route('employee.bayar')}}" class="" method="post">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="uang" class="form-label">Bayar :</label>
                            <input type="text" class="form-control" id="uang" name="uang" {{$totals == 0 ? 'disabled' : ''}}>
                        </div>
                        <div class="mb-3">
                            <label for="sisa" class="form-label">Kembalian :</label>
                            <input type="text" class="form-control" id="sisa" name="sisa" disabled>
                        </div>
                        <button class="btn btn-success" type="submit" id="bayar" disabled>Bayar</button>
                    </form>

                </div>
            </div>
            <div class="card border-primary col-12 mt-3">
                <div class="card-header text-white bg-primary d-flex">
                    <div class="col-8 mt-2">
                        Account
                    </div>
                    <div class="col-4 ms-5">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            @method('post')
                            <button class="btn btn-outline-light "
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body text-dark row d-flex">
                    <h3 class="text-center">{{$account->name}}</h3>
                    <h6 class="mt-2">Total transaksi hari ini : {{$saleintheday}}</h6>
                    <h6 class="mt-2">Total transaksi minggu ini : {{$saleintheweak}}</h6>
                    
                </div>
            </div>
        </div>

    </div>

    <script>
        /* Dengan Rupiah */
        var uang = document.getElementById('uang');
        uang.addEventListener('keyup', function (e) {
            var bayar = document.getElementById('bayar');
            var kembalian = document.getElementById('sisa');
            var angka = this.value;
            uang.value = formatRupiah(this.value, 'Rp ');
            var number_string = angka.replace(/[^,\d]/g, '').toString();
            var t = number_string - {{$totals}};
            if (t >= 0) {
                console.log(t.toString());
                kembalian.value = formatRupiah(t.toString(), 'Rp ');
                bayar.disabled = false;
            } else {
                bayar.disabled = true;
                kembalian.value = " ";
            }
        });


        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
</x-employee-layout>