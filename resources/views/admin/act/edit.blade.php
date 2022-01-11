@extends('admin/main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Create New</strong> User
                            </div>
                            <form action="/admin/update/{{ $user->id }}" method="post">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="username" class="form-label">Username</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                                                aria-describedby="emailHelp" autofocus required value="{{ $user->username }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="exampleInputPassword1" class="form-label">Role</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="role" id="role" class="form-control">
                                            @if ($user->role == 'user')
                                                <option value="user" selected>User</option>
                                                <option value="admin" >Admin</option>
                                                <option value="vendor" >Vendor</option>
                                            @elseif ($user->role == 'admin')
                                                <option value="user" >User</option>
                                                <option value="admin" selected>Admin</option>
                                                <option value="vendor" >Vendor</option>
                                            @else
                                                <option value="user" >User</option>
                                                <option value="admin" >Admin</option>
                                                <option value="vendor" selected>Vendor</option>
                                            @endif
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <a href="/administrator">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
