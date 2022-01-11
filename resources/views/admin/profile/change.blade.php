@extends('admin/main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        @if (session()->has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('failed') }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <strong>Change New</strong> Password
                            </div>
                            <form action="/admin/updatepw" method="POST">
                                @csrf
                                <div class="card-body card-block">
                                    <label for="password" class="form-label">Current Password </label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="show_password">Show</button>
                                        <button class="btn btn-outline-secondary d-none" type="button"
                                            id="hide_password">Hide</button>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <label for="new_password" class="form-label">New Password </label>
                                    <div class="input-group mb-3">
                                        <input type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            id="new_password" name="new_password" required>
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="show_new_password">Show</button>
                                        <button class="btn btn-outline-secondary d-none" type="button"
                                            id="hide_new_password">Hide</button>
                                        @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <a href="/admin/profile">
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
