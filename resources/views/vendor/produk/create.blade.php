@extends('vendor/main')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Produk</h4>
                        <form class="forms-sample" action="/vendor/addproduct" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" aria-describedby="emailHelp" autofocus required value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location" class="form-label">Kategori</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($category as $c)
                                        @if (old('category_id') == $c->id)
                                            <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                        @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" rows="3"
                                    required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                    name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty" class="form-label">Stok</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty"
                                    name="qty" value="{{ old('qty') }}" required>
                                @error('qty')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @if (old('status') == 'out-of-stock')
                                        <option value="ready">Ready</option>
                                        <option value="out-of-stock" selected>Out of Stock</option>
                                    @else
                                        <option value="ready" selected>Ready</option>
                                        <option value="out-of-stock">Out of Stock</option>
                                    @endif
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>
                                Tambah</button>
                            <a href="/yourmarket" class="btn btn-danger"><i class="ti-close"></i>
                                Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection