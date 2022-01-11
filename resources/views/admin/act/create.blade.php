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
                            <form action="/admin/dashboard" method="POST">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="username" class="form-label">Username</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                                id="username" name="username" aria-describedby="emailHelp" autofocus
                                                required value="{{ old('username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
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
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                                <option value="vendor">Vendor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                        </div>
                                        <div class="col-12 col-md-9 input-group">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                            <button class="btn btn-outline-secondary" type="button" id="show">Show</button>
                                            <button class="btn btn-outline-secondary d-none" type="button" id="hide">Hide</button>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="exampleInputPassword1" class="form-label">Status</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="status" id="status" class="form-control">
                                                <option value="available">Available</option>
                                                <option value="banned">Banned</option>
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
        <script>
            const show = document.getElementById('show')
            const hide = document.getElementById('hide')
            const password = document.getElementById('password')

            show.addEventListener('click', function() {
                show.classList.add('d-none')
                hide.classList.remove('d-none')
                password.setAttribute('type', 'text')
            })

            hide.addEventListener('click', function() {
                hide.classList.add('d-none')
                show.classList.remove('d-none')
                password.setAttribute('type', 'password')
            })
        </script>
    </div>
@endsection
