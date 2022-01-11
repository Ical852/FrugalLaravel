@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload New Image 2</h4>
                        <form class="forms-sample" action="/vendor/updateimg2/{{ $id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                    name="image" aria-describedby="emailHelp" autofocus required
                                    value="{{ old('image') }}">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>
                                Ubah</button>
                            <a href="/yourmarket" class="btn btn-danger"><i class="ti-close"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
