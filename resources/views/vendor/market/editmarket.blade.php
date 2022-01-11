@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Buka Toko</h4>
                        <form class="forms-sample" action="/vendor/updatemarket" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" aria-describedby="emailHelp" autofocus required
                                    value="{{ old('name', $market->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" rows="3"
                                    required>{{ old('description', $market->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    id="location" name="location" value="{{ old('location', $market->location) }}"
                                    required>
                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="request" class="form-label">Sedia Request Bahan ?</label>
                                <select id="request" name="request"
                                    class="form-control @error('request') is-invalid @enderror"
                                    value="{{ old('request', $market->request) }}">
                                    @if ($market->request == 'ya')
                                        <option value="ya" selected>Ya</option>
                                        <option value="tidak">Tidak</option>
                                    @else
                                        <option value="ya">Ya</option>
                                        <option value="tidak" selected>Tidak</option>
                                    @endif
                                </select>
                                @error('request')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>
                                Save</button>
                            <a href="/yourmarket" class="btn btn-danger"><i class="ti-close"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
