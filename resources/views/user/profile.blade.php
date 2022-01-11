@extends('user/main')
@section('content')
    <section class="profile container pt-5 mb-5">
        <div class="row">
            
            @if (session()->has('updated'))
                <div class="alert alert-success" role="alert">
                    {{ session('updated') }}
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
            @endif

            <div class="col-lg-4">
                <div class="card p-2 mt-5 mb-5">
                    <div class="p-2">
                        <img src="{{ asset('storage/'. $user->image) }}" alt="">
                    </div>
                    <div class="text-center">
                        <h5><i class="far fa-user"></i> {{ $user->username }}</h5>
                        <h5><i class="fas fa-tags"></i> {{ $user->role }}</h5>
                        <h5><i class="far fa-envelope"></i> {{ $user->email }}</h5>
                    </div>
                    <a href="/user/update" class="btn btn-primary btn-change">Change Photo</a>
                    <a href="/user/changepw" class="btn btn-primary mt-2 btn-change">Change Password</a>
                </div>
            </div>

            <div class="col-lg-8 mt-5">
                <form action="/user/updatep" method="POST">
                    @csrf
                    <h3 class="mb-3">Biodata Pribadi</h3>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                            value="{{ old('username', $user->username) }}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="birth" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birth" name="birth"
                            value="{{ $user->birth }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-select">
                            @if ($user->gender == 'L')
                                <option value="L" selected>Laki - laki</option>
                                <option value="P">Perempuan</option>
                            @elseif($user->gender == 'P')
                                <option value="L">Laki - laki</option>
                                <option value="P" selected>Perempuan</option>
                            @else
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="L">Laki - laki</option>
                                <option value="P">Perempuan</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ $user->phone_number }}">
                    </div>

                    <hr>
                    <button class="btn btn-primary mt-2 d-block btn-save" type="submit">Save</button>
                </form>
                <a href="/" style="text-decoration: none">
                    <button class="btn btn-primary mt-2 d-block btn-home">Home</button>
                </a>
                @if (auth()->user()->role == 'vendor')
                    <a href="/vendorpage" style="text-decoration: none">
                        <button class="btn btn-primary mt-2 d-block btn-home">Toko</button>
                    </a>
                @elseif(auth()->user()->role == 'admin')
                    <a href="/administrator" style="text-decoration: none">
                        <button class="btn btn-primary mt-2 d-block btn-home">Dashboard</button>
                    </a>
                @endif
                <form action="/logout" method="POST" style="margin-bottom: 50px">
                    @csrf
                    <button class="btn btn-primary mt-2 d-block btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </section>
@endsection