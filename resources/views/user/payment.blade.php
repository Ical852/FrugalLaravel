@extends('main')
@section('content')
	<style>
		.checked {
			color: orange
		}
	</style>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs" style="background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white">
                            <li class="active"><a href="/user/payment" class="text-white"> Payment</a> ---</li>
                            <li class="active"><a href="/user/onprocess" class="text-white">Sedang Di Proses</a> ---</li>
                            <li class="active"><a href="/user/ontheway" class="text-white">Sedang Di Perjalanan</a> ---</li>
                            <li class="active"><a href="/user/done" class="text-white">Pesanan Selesai</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Contact -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (Request::segment(2) == 'payment')
                            <h3>Pembayaran Pesanan</h3>
                            <hr>
                        @elseif(Request::segment(2) == 'onprocess')
                            <h3>Sedang Diproses</h3>
                            <hr>
                        @elseif(Request::segment(2) == 'ontheway')
                            <h3>Sedang Dikirim</h3>
                            <hr>
                        @elseif(Request::segment(2) == 'done')
                            <h3>Riwayat Pesanan Selesai</h3>
                            <hr>
                        @endif

                        <div class="form-main mt-3">
                            @if (!$cc)
                                <h5>Belum ada barang yg di checkout</h5>
                                <div class="col-12 mt-3">
                                    <div class="form-group button">
                                        <a href="/shop">
                                            <button type="button" class="btn ">Continue Shopping</button>
                                        </a>
                                    </div>
                                </div>
                            @else
                                @foreach ($checkout as $key => $c)
                                    <div class="form-main mt-3">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 stylegue">
                                                <img src="{{ asset('storage/' . $c->product->image) }}" alt=""
                                                    style="height: 150px; width:150px">
                                            </div>
                                            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12 stylegue">
                                                <h5> {{ $c->product->name }} </h5>
                                                <p class="mt-2">Quantity : {{ $c->qty }} </p>
                                                <h6 class="mt-2">Rp.
                                                    {{ number_format($c->product->price * $c->qty) }} </h6>
                                                <div class="mt-2">
                                                    <span><i class="fa fa-user"></i>
                                                        {{ $c->product->vendor->user->username }}</span>
                                                    <span class="mt-3"><i class="fa fa-home"></i>
                                                        {{ $c->product->vendor->name }}</span>
                                                    <span><i class="fa fa-location-arrow"></i>
                                                        {{ $c->product->vendor->location }} </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 text-center">
                                        <div class="form-group button">
                                            <a href="https://api.whatsapp.com/send?phone={{ $c->product->vendor->user->phone_number }}"
                                                style="display: inline-block" target="__blank">
                                                <button type="submit" class="btn ">Hubungi Penjual</button>
                                            </a>
                                            @if (Request::segment(2) == 'payment')
                                                <form action="/user/deletecheckout/{{ $c->id }}" method="post"
                                                    style="display: inline-block">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn" type="submit"
                                                        onclick="return confirm('Anda yakin cancel?')">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @elseif(Request::segment(2) == 'ontheway')
                                                
                                                <button data-toggle="modal" class="btn" data-target="#modald{{ $c->id }}">Selesaikan Pesanan</button>
                                            @elseif(Request::segment(2) == 'done')
                                                <form action="/shop" method="get" style="display: inline-block">
                                                    <button class="btn" type="submit">
                                                        Continue Shopping
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="modal fade" id="modald{{ $c->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span class="ti-close" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row no-gutters">
                                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                            <img src="{{ asset('storage/' . $c->product->image) }}" style="width:100%;">
                                                        </div>
                                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
															<form action="/user/rating/{{ $c->product_id.'-'.$c->id }}" method="post">
																@csrf
																<div class="quickview-content">
																<h1><Strong>Beri Ulasan ?</Strong></h1>
																<h3>Pastikan anda sudah menerima barang !!!</h3>
																	<div class="quickview-ratting-review">
																		<div class="quickview-ratting-wrap">
																			<span href onclick="return false;" class="fa fa-star" style="font-size: 30px"></span>
																			<span href onclick="return false;" class="fa fa-star" style="font-size: 30px"></span>
																			<span href onclick="return false;" class="fa fa-star" style="font-size: 30px"></span>
																			<span href onclick="return false;" class="fa fa-star" style="font-size: 30px"></span>
																			<span href onclick="return false;" class="fa fa-star" style="font-size: 30px"></span>
																		</div>
																	</div>
																	<div class="quickview-peragraph mt-3">
																		<textarea name="ulasan" id="ulasan" cols="30" rows="5" required>Terima Kasih</textarea>
																		<input type="number" name="rating" id="rating" class="d-none">
																	</div>
																	<div class="add-to-cart mt-3">
																		<button class="btn" type="submit" onclick="return check()">Kirim Ulasan</button>
																	</div>
																</div>
															</form>
															<form action="/user/accept/{{ $c->id }}" method="post">
																<div class="quickview-content">
																	@csrf
																	<button class="btn" type="submit">Selesaikan Saja</button>
																	<h3 style="display: inline-block">Lewati Jika tidak ingin</h3>
																</div>
															</form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-head">
                            <div class="single-info">
								<h5 class="mb-3">Need Help?</h5>
                                <i class="fa fa-phone"></i>
                                <h4 class="title">Call us Now:</h4>
                                <ul>
                                    <li><a href="https://api.whatsapp.com/send?phone=6281382967047" target="__blank">+62 813-8296-7047</a></li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-envelope-open"></i>
                                <h4 class="title">Email:</h4>
                                <ul>
                                    <li><a href="mailto:frugallife16@gmail.com">frugallife16@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->
    <script type="text/javascript">
        const centering = document.querySelectorAll('.stylegue')
        if (window.innerWidth <= 575) {
            centering.forEach(val => {
                val.classList.add('text-center')
            })
        }
        window.addEventListener('resize', () => {
            let width = window.innerWidth
            if (width <= 575) {
                centering.forEach(val => {
                    val.classList.add('text-center')
                })
            } else {
                centering.forEach(val => {
                    val.classList.remove('text-center')
                })
            }
        })
		$('.modal ').insertAfter($('body'));

		const stars = document.querySelectorAll('.fa-star')
		let rating = document.getElementById('rating')
		stars.forEach((element,index) => {
			element.addEventListener('click', () => {
				if (index == 0) {
					if (stars[1].classList.contains('checked') || 
						stars[2].classList.contains('checked') || 
						stars[3].classList.contains('checked') || 
						stars[4].classList.contains('checked')) {
							stars[1].classList.remove('checked')
							stars[2].classList.remove('checked')
							stars[3].classList.remove('checked')
							stars[4].classList.remove('checked')
					}
					stars[0].classList.add('checked')
					rating.value = 1
				} else if(index == 1) {
					if (stars[2].classList.contains('checked') || 
						stars[3].classList.contains('checked') || 
						stars[4].classList.contains('checked')) {
							stars[2].classList.remove('checked')
							stars[3].classList.remove('checked')
							stars[4].classList.remove('checked')
					}
					stars[0].classList.add('checked')
					element.classList.add('checked')
					rating.value = 2
				} else if(index == 2) {
					if (stars[3].classList.contains('checked') || 
						stars[4].classList.contains('checked')) {
							stars[3].classList.remove('checked')
							stars[4].classList.remove('checked')
					}
					stars[0].classList.add('checked')
					stars[1].classList.add('checked')
					element.classList.add('checked')
					rating.value = 3
				} else if(index == 3) {
					if (stars[4].classList.contains('checked')) {
						stars[4].classList.remove('checked')
					}
					stars[0].classList.add('checked')
					stars[1].classList.add('checked')
					stars[2].classList.add('checked')
					element.classList.add('checked')
					rating.value = 4
				} else if(index == 4) {
					stars[0].classList.add('checked')
					stars[1].classList.add('checked')
					stars[2].classList.add('checked')
					stars[3].classList.add('checked')
					element.classList.add('checked')
					rating.value = 5
				}
			})
		})
		stars.forEach((element,index) => {
			element.addEventListener('mouseover', () => {
				if (index == 0) {
					if (stars[1].classList.contains('checked') || 
						stars[2].classList.contains('checked') || 
						stars[3].classList.contains('checked') || 
						stars[4].classList.contains('checked')) {
							if (rating.value == 1 || 
								rating.value == 2 || 
								rating.value == 3 ||
								rating.value == 4 || 
								rating.value == 5) {
							} else {
								stars[1].classList.remove('checked')
								stars[2].classList.remove('checked')
								stars[3].classList.remove('checked')
								stars[4].classList.remove('checked')
							}
					}
					stars[0].classList.add('checked')
				} else if(index == 1) {
					if (stars[2].classList.contains('checked') || 
						stars[3].classList.contains('checked') || 
						stars[4].classList.contains('checked')) {
							if (rating.value == 2 || 
								rating.value == 3 ||
								rating.value == 4 || 
								rating.value == 5) {
							} else {
								stars[2].classList.remove('checked')
								stars[3].classList.remove('checked')
								stars[4].classList.remove('checked')
							}
					}
					stars[0].classList.add('checked')
					element.classList.add('checked')
				} else if(index == 2) {
					if (stars[3].classList.contains('checked') || 
						stars[4].classList.contains('checked')) {
							if (rating.value == 3 ||
								rating.value == 4 || 
								rating.value == 5) {
							} else {
								stars[3].classList.remove('checked')
								stars[4].classList.remove('checked')
							}
					}
					stars[0].classList.add('checked')
					stars[1].classList.add('checked')
					element.classList.add('checked')
				} else if(index == 3) {
					if (stars[4].classList.contains('checked')) {
						if (rating.value == 4 || 
							rating.value == 5) {
						} else {
							stars[4].classList.remove('checked')
						}
					}
					stars[0].classList.add('checked')
					stars[1].classList.add('checked')
					stars[2].classList.add('checked')
					element.classList.add('checked')
				} else if(index == 4) {
					if (rating.value == 5) {
					} else {
						
					}
					stars[0].classList.add('checked')
					stars[1].classList.add('checked')
					stars[2].classList.add('checked')
					stars[3].classList.add('checked')
					element.classList.add('checked')
				}
			})
		})
		stars.forEach((element,index) => {
			element.addEventListener('mouseout', () => {
				if (index == 0) {
					if (rating.value == 1 || 
						rating.value == 2 || 
						rating.value == 3 || 
						rating.value == 4 || 
						rating.value == 5) {
					} else {
						stars[0].classList.remove('checked')
					}
				} else if(index == 1) {
					if (rating.value == 2 ||
						rating.value == 3 || 
						rating.value == 4 || 
						rating.value == 5) {
					} else if(rating.value == 1) {
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else {
						stars[1].classList.remove('checked')
						stars[0].classList.remove('checked')
					}
				} else if(index == 2) {
					if (rating.value == 3 || 
						rating.value == 4 || 
						rating.value == 5) {
					} else if(rating.value == 1) {
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else if(rating.value == 1 || 
							rating.value == 2) {
							stars[2].classList.remove('checked')
							stars[3].classList.remove('checked')
							stars[4].classList.remove('checked')		
					} else {
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[0].classList.remove('checked')
					}
				} else if(index == 3) {
					if (rating.value == 4 || 
						rating.value == 5) {
					} else if(rating.value == 1) {
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else if(rating.value == 2) {
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else if(rating.value == 1 || 
							rating.value == 2 || 
							rating.value == 3) {
							stars[3].classList.remove('checked')
							stars[4].classList.remove('checked')
					} else {
						if (rating.value == 1 || 
							rating.value == 2 || 
							rating.value == 3) {
						}
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[0].classList.remove('checked')
					}
				} else if(index == 4) {
					if (rating.value == 5) {
					} else if(rating.value == 1) {
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else if(rating.value == 2) {
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else if(rating.value == 3) {
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
					} else if(rating.value == 1 || 
							rating.value == 2 || 
							rating.value == 3 || 
							rating.value == 4) {
							stars[4].classList.remove('checked')
					} else {
						stars[1].classList.remove('checked')
						stars[2].classList.remove('checked')
						stars[3].classList.remove('checked')
						stars[4].classList.remove('checked')
						stars[0].classList.remove('checked')
					}
				}
			})
		})

		function check() {
			if (rating.value < 1) {
				alert('Mohon Isi Bintang Terlebih Dahulu')
				return false
			}
		}
    </script>
@endsection
