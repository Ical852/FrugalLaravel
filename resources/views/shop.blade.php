@extends('main')
@section('content')
    <style>
        .pagination {
            list-style: none;
            padding-left: 0;
        }

        .pagination li {
            display: inline-block;
        }
    </style>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs" style="padding: 20px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="/" class="text-white">Home<i class="ti-arrow-right  text-white"></i></a></li>
                            <li class="active text-white">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Style -->
    <section class="product-area shop-sidebar shop section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="shop-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Categories </h3>
                            <ul class="categor-list">
                                <li><a href="/shop">All</a></li>
                                @foreach ($category as $c)
                                    <li>
                                        <a href="/shop/category/{{ $c->slug }}">{{ $c->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Market</h3>
                            <ul class="categor-list">
                                <li><a href="/shop">All</a></li>
                                @foreach ($market as $m)
                                    <li>
                                        <a
                                            href="/shop/market/{{ str_replace(' ', '_', $m->name) }}">{{ $m->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>Show :</label>
                                        <select id="show-item">
                                            <option selected="selected">30</option>
                                            <option>60</option>
                                            <option>90</option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <label>Sort By :</label>
                                        <select id="show-sort">
                                            <option selected="selected">Name</option>
                                            <option value="exp">Price++</option>
                                            <option value="cheap">Price--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    <div class="row">

                        @foreach ($products as $p)
                            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                                <div class="satu-product-v2">
                                    <a href="/shop/detail/{{ $p->id }}">
                                        <div class="product-img">
                                            <img class="default-img" src="{{ asset('storage/' . $p->image) }}" alt="#">
                                        </div>
                                        <div class="product-content mt-3">
                                            <h3><strong> {{ $p->name }} </strong></h3>
                                            <div class="product-price">
                                                <span class="text-danger">Rp. {{ number_format($p->price) }}</span>
                                            </div>
                                            <h3><i class="fa fa-location-arrow" style="font-size: 15px"></i>
                                                {{ $p->vendor->location }}</h3>
                                            @if (!$p->rating->count())
                                                <span style="margin: 5px"><i class="fa fa-star"
                                                        style="font-size: 15px"></i> 0
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

                    <div>
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
    </section>
    <!--/ End Product Style 1  -->

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

@endsection
