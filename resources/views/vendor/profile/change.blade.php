@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                
                @if (session()->has('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Change Password</h4>

                                <form class="forms-sample" action="/vendor/updatepw" method="POST">
                                    @csrf
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
                                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                                    <a href="/vendor/profile" class="btn btn-light">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const password = document.getElementById('password')
        const btnShowPassword = document.getElementById('show_password')
        const btnHidePassword = document.getElementById('hide_password')

        btnShowPassword.addEventListener('click', function() {
            btnShowPassword.classList.add('d-none')
            btnHidePassword.classList.remove('d-none')
            password.setAttribute('type', 'text')
        })

        btnHidePassword.addEventListener('click', function() {
            btnHidePassword.classList.add('d-none')
            btnShowPassword.classList.remove('d-none')
            password.setAttribute('type', 'password')
        })

        const newPassword = document.getElementById('new_password')
        const btnShowNewPassword = document.getElementById('show_new_password')
        const btnHideNewPassword = document.getElementById('hide_new_password')

        btnShowNewPassword.addEventListener('click', function() {
            btnShowNewPassword.classList.add('d-none')
            btnHideNewPassword.classList.remove('d-none')
            newPassword.setAttribute('type', 'text')
        })

        btnHideNewPassword.addEventListener('click', function() {
            btnHideNewPassword.classList.add('d-none')
            btnShowNewPassword.classList.remove('d-none')
            newPassword.setAttribute('type', 'password')
        })
    </script>
@endsection
