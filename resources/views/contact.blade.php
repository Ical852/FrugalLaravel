@extends('main')
@section('content')
	<style>
		.checked {
			color: orange
		}
	</style>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs" style="padding: 20px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white">
                            <li><a href="/" class="text-white">Home<i class="ti-arrow-right text-white"></i></a></li>
                            <li class="active">Contact Us</li>
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
                    <div class="col-lg-12 col-12">
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
@endsection
