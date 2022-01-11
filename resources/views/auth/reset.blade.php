@extends('auth/main')
@section('content')
    <!-- <div class="tap-top"><i data-feather="chevrons-up"></i></div>
            <div class="page-wrapper">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-card">
                                <div>
                                    <div class="login-main">
                                        <form class="theme-form" action="/send" method="post">
                                            @csrf
                                            <h4>Reset Your Password</h4>
                                            <p>Enter your email to get link for resetting password</p>

                                            @if (session()->has('failed'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ session('failed') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif

                                            @if (session()->has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            
                                            <div class="form-group">
                                                <label class="col-form-label">Enter Your Email</label>
                                                <div class="row">
                                                    <div class="col-4 col-sm-12">
                                                        <input class="form-control mb-1" type="email" id="email" name="email" required autofocus placeholder="Account@gmail.com">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="text-end">
                                                            <button class="btn btn-primary btn-block m-t-10"
                                                                type="submit">Send</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-4 mb-0 text-center">Already have an password?<a class="ms-2"
                                                    href="/">Sign in</a></p>
                                            <p class="mt-1 mb-0 text-center">Don't have account?<a class="ms-2"
                                                    href="/register">Create Account</a></p>
                                        </form>
                                    </div>
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
                            <form method="post" action="/change" method="post">
                                <div class="form-group">
                                    @csrf
                                    @if (session()->has('failed'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('failed') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if (session()->has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <label class="col-form-label">New Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" id="password" required="" placeholder="New Password">
                                    <input type="text" class="d-none" id="token" name="token" value="{{ $token }}">
                                    <div class="show-hide" @error('password') style="padding-right: 10px" @enderror>
                                        <span class="show"></span></div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="fxt-btn-fill">Reset</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center">
                            <p>Already have an password?<a href="/auth" class="switcher-text2 inline-text">Log in</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
