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
    <style>
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
    </style>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Single -->
    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="image">
                                    <img src="{{ asset('storage/'. $product->image) }}" style="width:100%;" id="imganjing">
                                </div>

                                <div class="image mt-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{ asset('storage/'. $product->image) }}" style="width:100p%;" class="showimg">
                                        </div>

                                        @if (!$product->image2)
                                        @else
                                            <div class="col-3">
                                                <img src="{{ asset('storage/'. $product->image2) }}" style="width:100p%;" class="showimg">
                                            </div>
                                        @endif
                                        
                                        @if (!$product->image3)
                                        @else
                                            <div class="col-3">
                                                <img src="{{ asset('storage/'. $product->image3) }}" style="width:100p%;" class="showimg">
                                            </div>
                                        @endif
                                        
                                        @if (!$product->image4)
                                        @else
                                            <div class="col-3">
                                                <img src="{{ asset('storage/'. $product->image4) }}" style="width:100p%;" class="showimg">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="blog-detail">
                                    <h2 class="blog-title">{{ $product->name }}</h2>
                                    <p>Ready Stok : {{ $product->qty }}</p>
                                    <div class="blog-meta mt-2">
                                        <span class="author">
                                            <a href="/toko/{{ str_replace(' ', '_', $product->vendor->name) }}"><i class="fa fa-shopping-bag"></i>{{ $product->vendor->name }}</a>
                                            <a href="#"><i class="fa fa-user"></i>{{ $product->vendor->user->username }}</a>
                                            <a href="#"><i class="fa fa-calendar"></i>{{ date('d-m-Y', strtotime($product->created_at)); }}</a>
                                            <a href="#"><i class="fa fa-location-arrow"></i>{{ $product->vendor->location }}</a>
                                        </span>
                                        <h4 class="mt-3">Rp. {{ number_format($product->price) }}</h4>

                                        @if ($product->vendor->request == 'ya')
                                            <h5 class="mt-3"><strong>Tersedia Request Bahan !!!</strong></h5>
                                        @endif
                                        
                                        <div class="mt-3">
                                            @guest
                                            <a href="/auth">
                                                <button class="btn btn-primary">Add To Cart</button>
                                            </a>
                                            <a href="/shop">
                                                <button class="btn btn-primary">Continue Shopping</button>
                                            </a>
                                            <a href="/auth">
                                                <button class="btn btn-primary ti-heart"></button>
                                            </a>
                                            @endguest
                                            @auth
                                                <form action="/user/add/{{ $product->id }}" style="display: inline-block" method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary">Add To Cart</button>
                                                </form>
                                                <a href="/shop">
                                                    <button class="btn btn-primary">Continue Shopping</button>
                                                </a>
                                                <form action="/user/wish/{{ $product->id }}" style="display: inline-block" method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary ti-heart"></button>
                                                </form>
                                            @endauth
                                        </div>
                                    </div>
                                    <h5>Description : </h5>
                                    <div class="content mt-3">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            @if (!$rating)
                            @else
                                @foreach ($rating as $r)
                                    <div class="col-12">
                                        <div class="comments ">
                                            <h3 class="comment-title">Review</h3>
                                            <!-- Single Comment -->
                                            <div class="single-comment">
                                                <img src="{{ asset('storage/'. $r->user->image) }}" alt="#">
                                                <div class="content">
                                                    <h4>{{ $r->user->username }} <span>{{ date('d-m-Y', strtotime($r->created_at)) }}</span></h4>
                                                    <div>
                                                        <span class="fa fa-star {{ ($r->rating == 1 ? 'checked' : $r->rating == 2) ? 'checked' : (($r->rating == 3 ? 'checked' : $r->rating == 4) ? 'checked' : ($r->rating == 5 ? 'checked' : '')) }} "></span>
                                                        <span class="fa fa-star {{ ($r->rating == 2 ? 'checked' : $r->rating == 3) ? 'checked' : (($r->rating == 4 ? 'checked' : $r->rating == 5) ? 'checked' : '') }}"></span>
                                                        <span class="fa fa-star {{ ($r->rating == 3 ? 'checked' : $r->rating == 4) ? 'checked' : ($r->rating == 5 ? 'checked' : '') }}"></span>
                                                        <span class="fa fa-star {{ ($r->rating == 4 ? 'checked' : $r->rating == 5) ? 'checked' : '' }}"></span>
                                                        <span class="fa fa-star {{ $r->rating == 5 ? 'checked' : '' }}"></span>
                                                    </div>
                                                    <p>{{ $r->ulasan }}</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                                <div>
                                    {{ $rating->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <div class="single-widget recent-post">
                            <h3 class="title">Cari Produk Lain Di Toko Ini</h3>
                        </div>
                        <div class="single-widget search">
                            <div class="form">
                                <form method="GET" action="/shop/market/{{ str_replace(' ', '_', $product->vendor->name) }}">
                                    <input type="text" name="search" placeholder="Search Here...">
                                    <button class="button" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="single-widget recent-post">
                            <h3 class="title">Produk Lain Di Toko Ini</h3>
                            <!-- Single Post -->
                            @foreach ($products as $p)
                                <div class="single-post">
                                <div class="image">
                                    <a href="/shop/detail/{{ $p->id }}">
                                    <img src="{{ asset('storage/'. $p->image ) }}" style="height: 80px; width:80px;">
                                    </a>
                                </div>
                                <div class="content">
                                    <h5><a href="/shop/detail/{{ $p->id }}">{{ $p->name }}</a></h5>
                                    <ul class="comment">
                                        <li>
                                            <i class="fa fa-calendar"></i>
                                            <strong>Rp. {{ number_format($p->price) }}</strong>
                                        </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        let primary = document.getElementById('imganjing')
        let showimg = document.querySelectorAll('.showimg')

        showimg.forEach(element => {
            element.addEventListener('mouseover', () => {
                primary.setAttribute(
                    "src", element.getAttribute('src')
                )
            })
        })
    </script>

@endsection