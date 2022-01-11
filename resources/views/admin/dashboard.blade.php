@extends('admin/main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Dashboard</h2>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-accounts"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $userc }}</h2>
                                        <span>Pengguna Terdaftar</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-accounts-list"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $vendor }}</h2>
                                        <span>Vendors</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c4">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-markunread-mailbox"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $products }}</h2>
                                        <span>Produk</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $transaction }}</h2>
                                        <span>Transaksi Berhasil</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="title-1 m-b-25">Data User</h2>
                        <a href="/admin/dashboard/create">
                            <button class="au-btn au-btn-icon au-btn--blue">Tambah Data</button>
                        </a>


                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped " id="datatable1" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Verified</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->username }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->role }}</td>
                                            <td>{{ $u->status }}</td>
                                            <td><img src="{{ asset('storage/' . $u->image) }}" width="100" height="100">
                                            </td>
                                            <td>{{ $u->phone_number ? $u->phone_number : 'none' }}</td>
                                            <td>{{ $u->email_verified_at ? 'Yes' : 'Not yet' }}</td>
                                            <td>
                                                <a href="/admin/edit/{{ $u->id }}">
                                                    <button class="btn btn-success mb-1">
                                                        <i class="fa fa-pencil-square"></i> Edit
                                                    </button>
                                                </a>

                                                @if ($u->email_verified_at)
                                                @else
                                                    <form action="/admin/verify/{{ $u->id }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-info mb-1" type="submit"><i
                                                                class="fa fa-check"></i>
                                                            Verify</button>
                                                    </form>
                                                @endif

                                                @if ($u->status == 'available')
                                                    <form action="/admin/ban/{{ $u->id }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-warning mb-1" type="submit"><i
                                                                class="fa fa-cancel"></i>
                                                            Ban</button>
                                                    </form>
                                                @else
                                                    <form action="/admin/unban/{{ $u->id }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-primary mb-1" type="submit"><i
                                                                class="fa fa-cancel"></i>
                                                            Unban</button>
                                                    </form>
                                                @endif

                                                <form action="/admin/destroy/{{ $u->email }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure ?')" type="submit"><i
                                                            class="fa fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <h2 class="title-1 m-b-25">Data Kategori</h2>
                        <a href="/admin/createcategory">
                            <button class="au-btn au-btn-icon au-btn--blue">Tambah Kategori</button>
                        </a>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped " id="datatable2" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->slug }}</td>
                                            <td>
                                                <a href="/admin/editcategory/{{ $c->id }}">
                                                    <button class="btn btn-success mb-1">
                                                        <i class="fa fa-pencil-square"></i> Edit
                                                    </button>
                                                </a>

                                                <form action="/admin/delcategory/{{ $c->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure ?')" type="submit"><i
                                                            class="fa fa-trash"></i> Delete</button>
                                                </form>
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
            $('#datatable1').DataTable();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable2').DataTable();
        });
    </script>
@endsection
