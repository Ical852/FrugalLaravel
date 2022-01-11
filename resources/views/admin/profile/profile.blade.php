@extends('admin/main')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Profile</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block"
                                        src="{{ asset('storage/' . $loged->image) }}" alt="Card image cap"
                                        style="width: 200px; height:200px">
                                    <h5 class="text-sm-center mt-2 mb-1">{{ $loged->username }}</h5>
                                    <div class="location text-sm-center">
                                        <i class="fa fa-tag"></i> {{ $loged->role }}
                                    </div>
                                    <div class="location text-sm-center">
                                        <i class="fa fa-envelope"></i> {{ $loged->email }}
                                    </div>
                                    <div class="text-center mt-2">
                                        <a href="/admin/changeimg">
                                            <button class="btn btn-success">
                                                <i class="fa fa-image"></i> Change Photo
                                            </button>
                                        </a>
                                        <a href="/admin/changepw">
                                            <button class="btn btn-secondary">
                                                <i class="fa fa-key"></i> Change Password
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Edit</strong> Profile
                                        </div>
                                        <form action="/admin/profileup" method="POST">
                                            @csrf
                                            <div class="card-body card-block">
                                                <div class="form-group">
                                                    <label for="username" class="form-label"><strong> Username
                                                        </strong></label>
                                                    <input type="text"
                                                        class="form-control text-center @error('username') is-invalid @enderror"
                                                        id="username" name="username"
                                                        value="{{ old('username', $user->username) }}">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="birth" class="form-label"><strong> Tanggal Lahir
                                                        </strong></label>
                                                    <input type="date" class="form-control text-center" id="birth"
                                                        name="birth" value="{{ $user->birth }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender" class="form-label"><strong> Jenis Kelamin
                                                        </strong></label>
                                                    <select name="gender" id="gender" class="form-control text-center">
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
                                                <div class="form-group">
                                                    <label for="phone_number" class="form-label"><strong> Phone Number
                                                        </strong></label>
                                                    <input type="text" class="form-control text-center" id="phone_number"
                                                        name="phone_number" value="{{ $user->phone_number }}">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
