@extends('user/main')
@section('content')
    <section class="change-photo vh-100" style="background-color: #013a20;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-md-block p-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $user->image) }}" width="100%" height="100%" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="/user/updateimg" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Change Photo</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Update Profile Photo</h5>

                                        <div class="form-outline mb-4">
                                            <label for="image" class="form-label">New Image </label>
                                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" required>
                                            @error('image')
                                                <div class="invalid-feedback @error('image') is-invalid @enderror">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Save</button>
                                            <a href="/user" class="btn btn-dark btn-lg btn-block"
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
    </section>
@endsection