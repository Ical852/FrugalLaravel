@extends('auth/main')
@section('content')
<!-- login page start-->
<!-- <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div class="login-main">
                            <form class="theme-form" action="/login" method="post">
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>

                                @if (session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('loginError') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('failed'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('failed') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('verified'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('verified') }}
                                    </div>
                                @endif

                                @if (session()->has('changed'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('changed') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" required="" placeholder="Account@mail.com" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" id="password" name="password" required=""
                                            placeholder="Password">
                                        <div class="show-hide">
                                            <a href onclick="return false" id="show" class="" @error('password') style="padding-right: 10px" @enderror>show</a>
                                            <a href onclick="return false" id="hide" class="d-none" @error('password') style="padding-right: 10px" @enderror>hide</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox" >
                                        <a class="link" href="/forgot">Forgot password?</a>
                                    </div>

                                    <div class="text-end mt-4">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                    </div>
                                </div>
                                <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2"
                                        href="/register">Create Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> -->

<section class="fxt-template-animation fxt-template-layout4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-12 fxt-bg-wrap">
                <div class="fxt-bg-img" data-bg-image="{{ asset('images/bg_login1.jpeg') }}">
                    <div class="fxt-header">
                        <div class="fxt-transformY-50 fxt-transition-delay-1">
                            <a href="/" class="fxt-logo"><img
                                    src="{{ asset('admin/images/auth.jpeg') }}" alt="Logo"></a>
                        </div>
                        <div class="fxt-transformY-50 fxt-transition-delay-2">
                            <h1>Selamat datang di Frugal</h1>
                        </div>
                        <div class="fxt-transformY-50 fxt-transition-delay-3">
                            <p>Tempat asik untuk berbelanja semua kebutuhan anda baik dari fashion maupun fashion dan
                                juga fashion.</p>
                        </div>
                    </div>
                    <ul class="fxt-socials">
                        <li class="fxt-facebook fxt-transformY-50 fxt-transition-delay-4"><a href="#"
                                title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="fxt-twitter fxt-transformY-50 fxt-transition-delay-5"><a href="#" title="twitter"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li class="fxt-google fxt-transformY-50 fxt-transition-delay-6"><a href="#" title="google"><i
                                    class="fab fa-google-plus-g"></i></a></li>
                        <li class="fxt-linkedin fxt-transformY-50 fxt-transition-delay-7"><a href="#"
                                title="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="fxt-youtube fxt-transformY-50 fxt-transition-delay-8"><a href="#" title="youtube"><i
                                    class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-12 fxt-bg-color">
                <div class="fxt-content">
                    <div class="fxt-form">
                        <form method="post" action="/login">
                            @csrf

                            @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session()->has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session()->has('verified'))
                            <div class="alert alert-success" role="alert">
                                {{ session('verified') }}
                            </div>
                            @endif

                            @if (session()->has('changed'))
                            <div class="alert alert-success" role="alert">
                                {{ session('changed') }}
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="email" class="input-label">Email Address</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="your_name@gmail.com" required="required"
                                    value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="input-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password"
                                    placeholder="type your password here" required="required">
                                <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                            </div>
                            <div class="form-group">
                                <div class="fxt-checkbox-area">
                                    <div class="checkbox">
                                        <!-- <input id="checkbox1" type="checkbox">
											<label for="checkbox1">Keep me logged in</label> -->
                                    </div>
                                    <a href="/forgot" class="switcher-text">Forgot Password</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="fxt-btn-fill">Log in</button>
                            </div>
                        </form>
                    </div>
                    <div class="fxt-footer">
                        <p>Don't have an account?<a href="/register" class="switcher-text2 inline-text">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection