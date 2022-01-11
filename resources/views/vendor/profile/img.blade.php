@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Gambar Profile</h3>
                    </div>
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-xl-10">
                                <div class="card" style="border-radius: 1rem;">
                                    <div class="row g-0">
                                        <div class="col-md-6 col-lg-5 d-md-block p-3">
                                            <div class="card p-2">
                                                <img src="{{ asset('storage/' . $user->image) }}" alt="" class="toko-profile">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                            <div class="card-body p-4 p-lg-5 text-black">
                                                <form action="/vendor/updatepimg" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="d-flex align-items-center mb-3 pb-1">
                                                        <span class="h1 fw-bold mb-0">Change
                                                            Photo</span>
                                                    </div>

                                                    <div class="form-outline mb-4">
                                                        <div class="form-group">
                                                            <label>New Image</label>
                                                            <input type="file" name="img[]" class="file-upload-default">
                                                            <div class="input-group col-xs-12">
                                                                <input type="file" name="image" id="image"
                                                                    class="form-control @error('image') is-invalid @enderror"
                                                                    required>
                                                                @error('image')
                                                                    <div
                                                                        class="invalid-feedback @error('image') is-invalid @enderror">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-1 mb-4">
                                                        <button class="btn btn-primary btn-lg btn-block"
                                                            type="submit">Save</button>
                                                        <a href="/vendor/profile" class="btn btn-dark btn-lg btn-block"
                                                            type="button">Back</a>
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
        </div>
    </div>
@endsection
