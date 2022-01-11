@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Toko Anda</h3>
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

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">

                @if (!$check)
                    <h5>Anda Belum Membuka Toko </h5>
                    <a href="/vendor/openmarket">
                        <button class="btn btn-primary"><i class="fa fa-shopping-basket"></i> Buka Toko</button>
                    </a>
                @else
                    <div class="row p-3">
                        <div class="col-md-12 mb-4 stretch-card transparent">
                            <div class="card p-5">
                                @if (!$check->image)
                                @else
                                    <img src="{{ asset('storage/' . $check->image) }}" alt="" class="toko-image"
                                        style="width: 150px; heigth:150px">
                                @endif
                                <h3 class="text-center mt-3">{{ $check->name }}</h3>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="/vendor/vendorimg" class="btn btn-primary btn-fw">
                                <i class="ti-pencil-alt"></i>
                                Ganti Foto
                            </a>
                            <a href="/vendor/editmarket" class="btn btn-success btn-fw">
                                <i class="ti-pencil-alt"></i>
                                Edit Toko
                            </a>
                            <form action="/vendor/closemarket" method="POST" class="mt-1"
                                style="display: inline-block">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-fw" onclick="return confirm('Are your sure?')"><i class="ti-close"></i> Tutup Toko</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-4 mt-4">
                            <div class="table-responsive mt-4 mb-5">
                                <h5>Produk Toko Anda</h5>

                                <a href="/vendor/createproduct">
                                    <button class="btn btn-primary mb-3">
                                        <i class="fa fa-plus"></i> Tambah Produk
                                    </button>
                                </a>

                                <table class="table table-striped" id="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Toko</th>
                                            <th scope="col">Nama Pemilik</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Gambar2</th>
                                            <th scope="col">Gambar3</th>
                                            <th scope="col">Gambar4</th>
                                            <th scope="col">Stok</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (!$checkproduct)
                                            <tr>
                                                <td class="text-center" colspan="14">
                                                    <Strong>
                                                        <h5> Belum Ada Produk</h5>
                                                    </Strong>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($products as $p)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $p->vendor->name }}</td>
                                                    <td>{{ $p->vendor->user->username }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->category->name }}</td>
                                                    <td>{{ $p->description }}</td>
                                                    <td>{{ $p->price }}</td>
                                                    <td>
                                                        @if (!$p->image)
                                                            <strong>Belum ada gambar !</strong>
                                                        @else
                                                            <img src="{{ asset('storage/' . $p->image) }}"
                                                                style="width: 150px; height:150px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$p->image2)
                                                            <strong>Belum ada gambar !</strong>
                                                        @else
                                                            <img src="{{ asset('storage/' . $p->image2) }}"
                                                                style="width: 150px; height:150px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$p->image3)
                                                            <strong>Belum ada gambar !</strong>
                                                        @else
                                                            <img src="{{ asset('storage/' . $p->image3) }}"
                                                                style="width: 150px; height:150px">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$p->image4)
                                                            <strong>Belum ada gambar !</strong>
                                                        @else
                                                            <img src="{{ asset('storage/' . $p->image4) }}"
                                                                style="width: 150px; height:150px">
                                                        @endif
                                                    </td>
                                                    <td>{{ $p->qty }}</td>
                                                    <td>{{ $p->status }}</td>
                                                    <td>
                                                        <a href="/vendor/editproduct/{{ $p->id }}">
                                                            <button class="btn btn-success mb-1">
                                                                <i class="fa fa-pencil-square"></i> Edit
                                                            </button>
                                                        </a>

                                                        <form action="/vendor/deleteproduct/{{ $p->id }}"
                                                            method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Are you sure ?')" type="submit"><i
                                                                    class="fa fa-trash"></i> Delete</button>
                                                        </form>

                                                        @if (!$p->image)
                                                            <a href="/vendor/uploadimg/{{ $p->id }}">
                                                                <button class="btn btn-info mt-1 text-white">
                                                                    <i class="fa fa-image"></i> Gambar
                                                                </button>
                                                            </a>
                                                        @else
                                                            <div>
                                                                <a href="/vendor/uploadimg/{{ $p->id }}">
                                                                    <button class="btn btn-info mt-1 text-white">
                                                                        <i class="fa fa-image"></i> Gambar 1
                                                                    </button>
                                                                </a><br>
                                                                <a href="/vendor/uploadimg2/{{ $p->id }}">
                                                                    <button class="btn btn-info mt-1 text-white">
                                                                        <i class="fa fa-image"></i> Gambar 2
                                                                    </button>
                                                                </a><br>
                                                                <a href="/vendor/uploadimg3/{{ $p->id }}">
                                                                    <button class="btn btn-info mt-1 text-white">
                                                                        <i class="fa fa-image"></i> Gambar 3
                                                                    </button>
                                                                </a><br>
                                                                <a href="/vendor/uploadimg4/{{ $p->id }}">
                                                                    <button class="btn btn-info mt-1 text-white">
                                                                        <i class="fa fa-image"></i> Gambar 4
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
                <script>
                    $(document).ready(function() {
                        $('#table').DataTable();
                    });
                </script>
@endsection
