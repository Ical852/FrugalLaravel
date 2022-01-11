@extends('admin/main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
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
            $('#datatable2').DataTable();
        });
    </script>
@endsection
