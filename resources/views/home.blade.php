@extends('main')
@section('content')
    <!-- Start Cowndown Area -->
    <div class="breadcrumbs" style="padding: 10px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white" id="catlist">
                            <i class="fa fa-sitemap text-white"></i> Category <i class="fa fa-sitemap text-white pr-5"></i>
                            @foreach ($category as $c)
                                <li class="active text-white"><a href="/shop/category/{{ $c->slug }}"
                                        class="text-white">
                                        {{ $c->name }} </a> - </li>
                            @endforeach
                        </ul>
                        <div class="dropdown d-none" id="catdropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-sitemap"></i> Category
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($category as $c)
                                    <a class="dropdown-item"
                                        href="/shop/category/{{ $c->slug }}">{{ $c->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="cown-down mt-5">
        <div class="section-inner ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12 padding-right leftside">
                        <div class="image">
                            <img src="{{ asset('images/testad.jpeg') }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 padding-left rightside">
                        <div class="content">
                            <div class="heading-block">
                                <img src="{{ asset('admin/images/home.png') }}" alt="" style="width:300px; height:90px">
                                <p class="small-title">Frugal</p>
                                <h3 class="title">Website Penyedia Pakaian Reworked</h3>
                                <p class="text">Berbagai macam pakaian rework dari baju hingga jaket dan masi
                                    banyak lainnya
                                    yang dibuat menggunakan bahan baju bekas. Tertarik untuk membeli bahan atau bahkan
                                    request
                                    bahan untuk pesanan yang anda inginkan ?. Ke shop sekarang</p><br>
                                <button href="/shop" class="btn">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Cowndown Area -->



    <section class="product-area mt-5 centeringcontent">
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-6 col-12 d-none" id="aboutimg">
                    <div class="content imgcontent">
                        <img src="{{ asset('images/about.jpeg') }}" style="width:50%;">
                    </div>
                </div>
                <div class="col-lg-6 col-12 textcontent">
                    <h3>About Reworked Clothes</h3><br />
                    <p>Semua jenis fashion yang terdapat dalam website ini merupakan barang yang echo friendly
                        karena terbuat dari hasil recycle jadi dengan anda membeli barang dari sini maka anda ikut
                        turut serta berpartisipasi dalam pengurangan limbah fashion</p>
                    <a href="/blog" class="btn m-3 text-white">Read More</a>
                </div>
                <div class="col-lg-6 col-12 aboutimg2">
                    <div class="content">
                        <img src="{{ asset('images/about.jpeg') }}" style="width:50%; float:right">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-area centeringcontent">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 col-12">
                    <div class="content imgcontent">
                        <img src="{{ asset('images/matches.jpeg') }}" style="width:50%;">
                    </div>
                </div>
                <div class="col-lg-6 col-12 textcontent">
                    <h3>Find Your Matches</h3><br />
                    <p>Cari fashion yang cocok dengan kamu pada website ini. Jelajahi keinginan fashion mu pada
                        Frugal.</p>
                    <a href="/shop" class="btn m-3 text-white">Shop Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="breadcrumbs" style="padding: 20px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-inner text-center">
                            <h5><i class="fa fa-tools"></i> Reworked Products</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs changed">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-inner">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="tab-content" id="myTabContent">
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade show active" id="man" role="tabpanel">
                                <div class="tab-single customed">
                                    <div class="row kastem">
                                        @foreach ($products as $p)
                                            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                                                <div class="satu-product">
                                                    <a href="/shop/detail/{{ $p->id }}">
                                                        <div class="product-img">
                                                            <img class="default-img"
                                                                src="{{ asset('storage/' . $p->image) }}" alt="#">
                                                        </div>
                                                        <div class="product-content mt-3">
                                                            <h3><strong> {{ $p->name }} </strong></h3>
                                                            <div class="product-price">
                                                                <span class="text-danger">Rp.
                                                                    {{ number_format($p->price) }}</span>
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
                                </div>
                            </div>
                            <!--/ End Single Tab -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    <!-- Start Midium Banner  -->
    <section class="midium-banner">
        <div class="container">
            <div class="row">
                <!-- Single Banner  -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('images/5.jpeg') }}" alt="#">
                        <div class="content">
                            <p>Reworked Product</p>
                            <h3>Barang Rework<br>asli</h3>
                            <a href="/shop">Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- /End Single Banner  -->
                <!-- Single Banner  -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('images/6.jpeg') }}" alt="#">
                        <div class="content">
                            <p>Frugal</p>
                            <h3>Bisa Request<br> Bahan</h3>
                            <p class="text-white">- bagi vendor yg menyediakan -</p>
                            <a href="/shop" class="btn">Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- /End Single Banner  -->
            </div>
        </div>
    </section>
    <!-- End Midium Banner -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Newest Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->
                        @foreach ($new as $p)
                            <div class="satu-product" style="padding-right: 10px; padding-top:5px; padding-bottom:5px">
                                <a href="/shop/detail/{{ $p->id }}">
                                    <div class="product-img">
                                        <img class="default-img" src="{{ asset('storage/' . $p->image) }}" alt="#">
                                    </div>
                                    <div class="product-content mt-3">
                                        <h3><strong> {{ $p->name }} </strong></h3>
                                        <div class="product-price">
                                            <span class="text-danger">Rp.
                                                {{ number_format($p->price) }}</span>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->


    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service text-center">
                        <h4>Reworked Product ?</h4>
                        <p>Why Reworked Product ?</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    <section class="midium-banner mt-5 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <video playsinline="" loop="loop" autoplay="autoplay" muted="muted"
                        src="{{ asset('images/vid1.mp4') }}" style='width:100%;height:100%'></video>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Latest Order</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($latest as $l)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-12">
                        <!-- Start Single Blog  -->
                        <div class="shop-single-blog">
                            <img src="{{ asset('storage/' . $l->product->image) }}" alt="#">
                            <div class="content">
                                <p class="date">{{ $l->updated_at->format('d/m/Y') }}</p>
                                <a class="title">{{ $l->product->name }}</a>
                                <a class="more-btn">{{ $l->user->email }}</a>
                            </div>
                        </div>
                        <!-- End Single Blog  -->
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <script type="text/javascript">
        const catlist = document.getElementById('catlist')
        const catdd = document.getElementById('catdropdown')
        const about = document.getElementById('aboutimg')
        const center = document.querySelectorAll('.centeringcontent')
        const text = document.querySelectorAll('.textcontent')

        window.addEventListener("resize", function() {
            if (window.innerWidth < 768) {
                catdd.classList.remove('d-none')
                about.classList.remove('d-none')
                catlist.classList.add('d-none')
            } else {
                catdd.classList.add('d-none')
                about.classList.add('d-none')
                catlist.classList.remove('d-none')
            }
        });

        if (window.innerWidth < 768) {
            catdd.classList.remove('d-none')
            catlist.classList.add('d-none')
        } else {
            catdd.classList.add('d-none')
            catlist.classList.remove('d-none')
        }

        window.addEventListener("resize", function() {
            if (window.innerWidth < 991) {
                center.forEach(element => {
                    element.classList.add('text-center')
                })
                text.forEach(element => {
                    element.classList.add('mt-3')
                })
                about.classList.remove('d-none')
            } else {
                center.forEach(element => {
                    element.classList.remove('text-center')
                })
                text.forEach(element => {
                    element.classList.remove('mt-3')
                })
                about.classList.add('d-none')
            }
        });

        if (window.innerWidth < 991) {
            center.forEach(element => {
                element.classList.add('text-center')
            })
            text.forEach(element => {
                element.classList.add('mt-3')
            })
            about.classList.remove('d-none')
        } else {
            center.forEach(element => {
                element.classList.remove('text-center')
            })
            text.forEach(element => {
                element.classList.remove('mt-3')
            })
            about.classList.add('d-none')
        }
    </script>
    <!-- End Shop Blog  -->
@endsection
