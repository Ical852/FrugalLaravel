@extends('user/main')
@section('content')
    <section class="vh-100" style="background-color: #013a20;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">

                            @if (session()->has('failed'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('failed') }}
                                </div>
                            @endif
                            
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="/user/resetpw" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Change Password</span>
                                        </div>

                                        <label for="password" class="form-label">Current Password </label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="show_password">Show</button>
                                            <button class="btn btn-outline-secondary d-none" type="button" id="hide_password">Hide</button>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <label for="new_password" class="form-label">New Password </label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                            <button class="btn btn-outline-secondary" type="button" id="show_new_password">Show</button>
                                            <button class="btn btn-outline-secondary d-none" type="button" id="hide_new_password">Hide</button>
                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Save</button>
                                            <a href="/user" class="btn btn-dark btn-lg btn-block" type="button">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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