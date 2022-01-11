@extends('main')
@section('content')

    <div class="breadcrumbs" style="padding: 20px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white">
                            <li><a href="/" class="text-white">Home<i class="ti-arrow-right text-white"></i></a></li>
                            <li class="active">Detail Product</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="breadcrumbs mt-5" style="padding-bottom: 150px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-inner">
                            <div class="row">
                                <div class="col-3">
                                    <ul class="bread-list text-dark">
                                        <img src="{{ asset('storage/' . $vendor->image) }}" alt=""
                                            style="width: 100%;">
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h5 class="mt-3"><i class="ti-bag"></i> {{ $vendor->name }}</h5>
                                    <h5 class="mt-3"><i class="fa fa-location-arrow"></i> {{ $vendor->location }}</h5>
                                    <h5 class="mt-3"><i class="fa fa-info-circle"></i> {{ $vendor->description }}</h5>
                                    <h5 class="mt-3"><i class="fa fa-question-circle"></i> Sedia Request = {{ strtoupper($vendor->request) }}</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    <section class="detail-vendor p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 toko">
                                    <img src="{{ asset('storage/' . $vendor->image) }}" alt="">
                                </div>
                                <div class="col-lg-3 toko">
                                    <h5> {{ $vendor->name }}</h5>
                                    <i class="fas fa-map-marker-alt mt-3"></i><a href=""> {{ $vendor->location }}</a>
                                    <p><i class="fa fa-question-circle"></i> Sedia Request =
                                        {{ strtoupper($vendor->request) }}</p>
                                    <div class="mt-3">
                                        <a href="https://api.whatsapp.com/send?phone={{ $vendor->user->phone_number ? $vendor->user->phone_number : '' }}"
                                            target="__blank">
                                            <button class="btn btn-success">Chatt Penjual</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 ms-0 description">
                                    <h5>Deskripsi Toko</h5>
                                    <div class="text-muted mt-3 deskripsi">
                                        <p>{{ $vendor->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <section class="vendor-product pb-5">
        <div class="container">
            <h5>Product Toko</h5>
            <div class="row">
                @foreach ($product as $p)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-6">
                        <div class="satu-product">
                            <a href="/shop/detail/{{ $p->id }}">
                                <div class="product-img">
                                    <img class="default-img" src="{{ asset('storage/' . $p->image) }}" alt="#">
                                </div>
                                @if ($p->status == 'ready')
                                    <p class="label label-tersedia">Tersedia</p>
                                @else
                                    <p class="label label-habis">Habis</p>
                                @endif
                                <div class="product-content mt-3">
                                    <h3><strong> {{ $p->name }} </strong></h3>
                                    <div class="product-price">
                                        <span class="text-danger">Rp.
                                            {{ number_format($p->price) }}</span>
                                    </div>
                                    <h3><i class="fa fa-location-arrow" style="font-size: 15px"></i>
                                        {{ $p->vendor->location }}</h3>
                                    @if (!$p->rating->count())
                                        <span style="margin: 5px"><i class="fa fa-star" style="font-size: 15px"></i> 0
                                        </span>
                                    @else
                                        <span style="margin: 5px"><i class="fa fa-star"
                                                style="font-size: 15px; color:orange"></i>
                                            {{ $p->rating->sum('rating') / $p->rating->count() }}
                                        </span>
                                    @endif
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

    <script type="text/javascript">
        const select = document.getElementById('show-item')
        select.onchange = function() {
            const val = select.value
            axios.get(`?show=${val}`)
                .then(function(response) {
                    //console.log(response);
                    window.location.href = `?show=${val}`
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        const sort = document.getElementById('show-sort')
        sort.onchange = function() {
            const val = sort.value
            axios.get(`?sort=${val}`)
                .then(function(response) {
                    //console.log(response);
                    window.location.href = `?sort=${val}`
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>

    <script type="text/javascript">
        window.addEventListener("resize", function() {
            console.log(window.innerWidth);
        });
    </script>

    <!-- End Breadcrumbs -->

    <!-- Start Blog Single -->
    <!-- <section class="blog-single section">
            <div class="container">

            </div>
        </section> -->

@endsection
