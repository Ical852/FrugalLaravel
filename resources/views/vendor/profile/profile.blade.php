@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">

                @if (session()->has('updated'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('updated') }}
                    </div>
                @endif
                @if (session()->has('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Profile</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card p-2 mt-5 mb-5 text-center">
                                    <div class="p-2">
                                        <img src="{{ asset('storage/'. $user->image) }}" alt="" class="toko-profile">
                                    </div>
                                    <div class="text-center mt-3 mb-3">
                                        <h5><i class="far fa-user"></i> {{ $user->username }}</h5>
                                        <h5><i class="fas fa-tags"></i> {{ $user->role }}</h5>
                                        <h5><i class="far fa-envelope"></i> {{ $user->email }}</h5>
                                    </div>
                                    <a href="/vendor/changeimg" class="btn btn-primary btn-change"><i
                                            class="ti-image"></i> Change
                                        Photo</a>
                                    <a href="/vendor/changepw" class="btn btn-primary mt-2 btn-change"><i
                                            class="ti-key"></i>Change
                                        Password</a>
                                </div>
                            </div>

                            <div class="col-lg-8 mt-5">
                                <form class="form-sample" action="/vendor/profileup" method="POST">
                                    @csrf
                                    <h3 class="mb-3">Ubah Biodata Pribadi</h3>
                                    <div class="mb-3">
                                        <label for="username" class="form-label"><strong> Username
                                            </strong></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username', $user->username) }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="birth" class="form-label"><strong> Tanggal Lahir
                                            </strong></label>
                                        <input type="date" class="form-control " id="birth" name="birth"
                                            value="{{ $user->birth }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="form-label"><strong> Jenis Kelamin
                                            </strong></label>
                                        <select name="gender" id="gender" class="form-control ">
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
                                        <label for="phone_number" class="form-label"><strong> Phone Number
                                            </strong></label>
                                        <input type="text" class="form-control " id="phone_number"
                                            name="phone_number" value="{{ $user->phone_number }}">
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary mt-2 btn-save text-center"><i class="ti-save"></i>
                                        Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
