@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome {{ $user->username }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white" type="button" id="dropdownMenuDate2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> {{ now() }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Produk Anda</p>
                                <p class="fs-30 mb-2">{{ $tp }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Transaksi Berhasil</p>
                                <p class="fs-30 mb-2">{{ $tt }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <h2>Semua Pesanan</h2>
                <hr>
                @if ($check)
                    <div class="mb-3">
                        <form method="get" style="display: inline-block" action="/vendorpage">
                            <button class="btn btn-secondary" type="submit">All</button>
                        </form>

                        <form method="get" style="display: inline-block">
                            <input type="text" name="status" value="checkout" class="d-none">
                            <button class="btn btn-primary" type="submit">Checkout</button>
                        </form>

                        <form method="get" style="display: inline-block">
                            <input type="text" name="status" value="diproses" class="d-none">
                            <button class="btn btn-success" type="submit">Diproses</button>
                        </form>

                        <form method="get" style="display: inline-block">
                            <input type="text" name="status" value="dikirim" class="d-none">
                            <button class="btn btn-warning" type="submit">Dikirim</button>
                        </form>

                        <form method="get" style="display: inline-block">
                            <input type="text" name="status" value="selesai" class="d-none">
                            <button class="btn btn-info text-white" type="submit">Selesai</button>
                        </form>
                    </div>
                @endif

                @if (session()->has('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped" id="table" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Stok Tersedia</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Jumlah Pesan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!$pesanan)
                                <tr>
                                    <td colspan="11" class="text-center"><strong> Anda Belum Buka Toko </strong></td>
                                </tr>
                                <tr>
                                    <td colspan="11" class="text-center">
                                        <a href="/yourmarket">
                                            <button class="btn btn-primary">Ke Halaman Toko</button>
                                        </a>
                                    </td>
                                </tr>
                            @else
                                @if (!$check)
                                    <td colspan="10" class="text-center"><strong> Belum Ada Pesanan </strong></td>
                                @else
                                    @foreach ($pesanan as $p)
                                        <tr>
                                            <td> {{ $loop->iteration }} </td>
                                            <td> <img src="{{ asset('storage/' . $p->product->image) }}"
                                                    style="height: 100px; width:100px;"> </td>
                                            <td> {{ $p->product->name }} </td>
                                            <td class="@if ($p->qty == $p->product->qty) text-warning @elseif($p->qty > $p->product->qty) text-danger @else text-info @endif">
                                                {{ $p->product->qty }}
                                            </td>
                                            <td>Rp. {{ number_format($p->product->price) }} </td>
                                            <td> {{ $p->qty }} </td>
                                            <td>Rp. {{ number_format($p->qty * $p->product->price) }} </td>
                                            <td> {{ $p->user->username }} </td>
                                            <td> {{ $p->user->address->name }} </td>
                                            <td> {{ $p->status }} </td>
                                            <td>
                                                @if ($p->status == 'checkout')
                                                    <form action="/vendor/confirm/{{ $p->id }}" method="post"
                                                        style="display: inline-block">
                                                        @csrf
                                                        <button class="btn btn-primary"
                                                            onclick="return confirm('Konfirmasi Pesanan {{ $p->user->username }} ? ')">Konfirmasi</button>
                                                    </form>
                                                @elseif($p->status == 'diproses')
                                                    <form action="/vendor/send/{{ $p->id }}" method="post"
                                                        style="display: inline-block">
                                                        @csrf
                                                        <button class="btn btn-success"
                                                            onclick="return confirm('Kirim Pesanan {{ $p->user->username }} ? ')">Kirim
                                                            Pesanan</button>
                                                    </form>
                                                @else

                                                @endif

                                                @if ($p->status == 'checkout' or $p->status == 'diproses')
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#cancel{{ $p->id }}">Batalkan
                                                        Pesanan</button>
                                                @else

                                                @endif
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="cancel{{ $p->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="/vendor/cancel/{{ $p->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Batalkan
                                                                Pesanan ?</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <div class="mb-3">
                                                                <img src="{{ asset('storage/' . $p->product->image) }}"
                                                                    style="height: 220px; width:220px">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Pemesan : {{ $p->user->username }}</label>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Produk : {{ $p->product->name }}</label>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Alasan :
                                                                </label>
                                                                <textarea class="form-control" id="message-text"
                                                                    name="alasan" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Batalkan
                                                                Pesanan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    @endforeach
                                @endif
                            @endif

                        </tbody>
                    </table>
                </div>
                <hr>
                <script>
                    $(document).ready(function() {
                        $('#table').DataTable();
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
