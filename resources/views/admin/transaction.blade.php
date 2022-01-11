@extends('admin/main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="title-1 m-b-25">Data Transaksi</h2>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped " id="datatable2" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Pemesan</th>
                                        <th scope="col">Email Pemesan</th>
                                        <th scope="col">Gambar Pemesan</th>
                                        <th scope="col">Alamat Pemesan</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Kategori Produk</th>
                                        <th scope="col">Gambar Produk</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Nama Vendor</th>
                                        <th scope="col">Lokasi Vendor</th>
                                        <th scope="col">Gambar Vendor</th>
                                        <th scope="col">Nama Pemilik</th>
                                        <th scope="col">Email Pemilik</th>
                                        <th scope="col">Gambar Pemilik</th>
                                        <th scope="col">Status Pesanan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->user->username }}</td>
                                            <td>{{ $c->user->email }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$c->user->image) }}">
                                            </td>
                                            <td>{{ $c->user->address->name }}</td>
                                            <td>{{ $c->product->name }}</td>
                                            <td>{{ $c->product->category->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$c->product->image) }}" alt="">
                                            </td>
                                            <td>Rp. {{ number_format($c->product->price) }}</td>
                                            <td>{{ $c->qty }}</td>
                                            <td>Rp. {{ number_format($c->qty * $c->product->price) }}</td>
                                            <td>{{ $c->product->vendor->name }}</td>
                                            <td>{{ $c->product->vendor->location }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'. $c->product->vendor->image) }}" alt="">
                                            </td>
                                            <td>{{ $c->product->vendor->user->username }}</td>
                                            <td>{{ $c->product->vendor->user->email }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$c->product->vendor->user->image) }}" alt="">
                                            </td>
                                            <td>{{ $c->status }}</td>
                                            <td>
                                                <a href="mailto:{{ $c->product->vendor->user->email }}">
                                                    <button class="btn btn-primary">Email Penjual</button>
                                                </a>
                                                <a href="mailto:{{ $c->user->email }}">
                                                    <button class="btn btn-success">Email Pembeli</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable2').DataTable();
        });
    </script>
@endsection