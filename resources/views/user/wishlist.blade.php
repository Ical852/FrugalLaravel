@extends('main')
@section('content')

    <div class="breadcrumbs" style="padding: 20px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white">
                            <li><a href="/" class="text-white">Home<i class="ti-arrow-right text-white"></i></a></li>
                            <li class="active">Wishlist Anda</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="vendor-product pb-5">
        <div class="container">

            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
            @endif

            <h5 class="mt-5">Wishlist Anda</h5>
            @if (!$wishlist->first())
                <div style="margin-bottom: 500px">
                    Belum ada wishlist
                </div>
            @endif
            <div class="row">
                @foreach ($wishlist as $p)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                        <div class="satu-product">
                            <a href="/shop/detail/{{ $p->product->id }}">
                                <div class="product-img">
                                    <img class="default-img" src="{{ asset('storage/' . $p->product->image) }}" alt="#">
                                </div>
                                <div class="product-content mt-3">
                                    <h3><strong> {{ $p->product->name }} </strong></h3>
                                    <div class="product-price">
                                        <span class="text-danger">Rp.
                                            {{ number_format($p->product->price) }}</span>
                                    </div>
                                    <h3><i class="fa fa-location-arrow" style="font-size: 15px"></i>
                                        {{ $p->product->vendor->location }}</h3>
                                    @if (!$p->product->rating->count())
                                        <span style="margin: 5px"><i class="fa fa-star" style="font-size: 15px"></i> 0
                                        </span>
                                    @else
                                        <span style="margin: 5px"><i class="fa fa-star"
                                                style="font-size: 15px; color:orange"></i>
                                            {{ $p->product->rating->sum('rating') / $p->product->rating->count() }}
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <form action="/user/wishdel/{{ $p->id }}" class="mt-2" method="post">
                                        @csrf
                                        <button class="btn text-center" type="submit" onclick="return confirm('Hapus Wishlist?')">Hapus Wishlist</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <style>
        p {
            color: black;
        }

        section.detail-vendor img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
        }

        section.detail-vendor .card {
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.082);
        }

        section.detail-vendor a {
            text-decoration: none;
            color: black;
        }

        section.detail-vendor .star {
            font-size: 30px;
            color: yellow;
        }

        .pagination {
            list-style: none;
            padding-left: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .checked {
            color: orange;
        }

        section.detail-vendor .deskripsi {
            text-align: justify;
        }

        .pagination {
            list-style: none;
            padding-left: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .single-product {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            padding: 10px;
        }

        .single-product:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .default-img {
            width: 100%;
            height: 200px;
            object-fit: scale-down;
        }

        section.vendor-product .label-tersedia {
            background-color: #013a20;
            padding: 3px;
            color: white;
            text-align: center;
            margin-bottom: 7px;
        }

        section.vendor-product .label-habis {
            background-color: red;
            padding: 3px;
            color: white;
            text-align: center;
            margin-bottom: 7px;
        }

        div.product-img p {
            position: absolute;
            right: 0px;
            top: 0px;
        }

        @media(max-width: 991px) {
            section.detail-vendor .toko {
                text-align: center;
            }

            section.detail-vendor .description {
                margin-top: 30px;
            }
        }

        @media(max-width:450px) {
            .default-img {
                height: 150px;
            }
        }

        @media(max-width:350px) {
            .default-img {
                height: 120px;
            }
        }

    </style>

@endsection
