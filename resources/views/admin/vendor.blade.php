@extends('admin/main')
@section('content')
    <style>
        .d-none {
            transition: 1s;
        }
        .pemilik {
        }
    </style>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">

                                @foreach ($vendor as $v)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <div class="card-header text-center btnvendor">
                                                <strong class="card-title mb-3">{{ $v->name }}</strong>
                                            </div>
                                            <div class="card-body vendor">
                                                <div class="mx-auto d-block">
                                                    @if (!$v->image)
                                                        <img class="rounded-circle mx-auto d-block" src="{{ asset('storage/profile-images/user.png') }}"
                                                        alt="Card image cap" style="width: 100px; height:100px">
                                                    @else
                                                        <img class="rounded-circle mx-auto d-block" src="{{ asset('storage/'. $v->image ) }}"
                                                        alt="Card image cap" style="width: 100px; height:100px">
                                                    @endif
                                                    <h5 class="text-sm-center mt-2 mb-1">{{ $v->name }}</h5>
                                                    <div class="location text-sm-center mb-1">
                                                        <i class="fa fa-map-marker"></i> {{ $v->location }}
                                                    </div>
                                                    <hr style="width: 50%; margin:auto; border-width:1px; border-color:black;">
                                                    <div class="location text-sm-center">
                                                        <i class="fa fa-info-circle mt-3"></i> Description :
                                                    </div>
                                                    <div class="location text-sm-center">
                                                        {{ $v->description }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-header text-center btnpemilik">
                                                <strong class="card-title mb-3">Pemilik</strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="mx-auto d-none pemilik">
                                                    <img class="rounded-circle mx-auto d-block" src="{{ asset('storage/'. $v->user->image) }}"
                                                        alt="Card image cap" style="width: 100px; height:100px">
                                                    <h5 class="text-sm-center mt-2 mb-1">{{ $v->user->username }}</h5>
                                                    <div class="location text-sm-center mb-1">
                                                        <i class="fa fa-tag"></i> {{ $v->user->role }}
                                                    </div>
                                                    <div class="location text-sm-center mb-1">
                                                        <i class="fa fa-envelope"></i> {{ $v->user->email }}
                                                    </div>
                                                    <div class="location text-sm-center mb-1">
                                                        <i class="fa fa-info-circle"></i> {{ $v->user->status }}
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="card-text text-sm-center">
                                                    <a href="https://api.whatsapp.com/send?phone={{ $v->user->phone_number }}" target="__blank">
                                                        <button class="btn btn-success">
                                                        <i class="fa fa-whatsapp " style="font-size: 18px;"> </i> Whatsapp
                                                        </button>
                                                    </a>
                                                    <a href="mailto:{{ $v->user->email }}">
                                                        <button class="btn btn-danger">
                                                        <i class="fa fa-google" style="font-size: 18px;"> </i> Gmail
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        const vendor = document.querySelectorAll('.vendor')
        const pemilik = document.querySelectorAll('.pemilik')

        const btnvendor = document.querySelectorAll('.btnvendor')
        const btnpemilik = document.querySelectorAll('.btnpemilik')

        btnpemilik.forEach((element,index) => {
            element.addEventListener('click', () => {
                pemilik[index].classList.toggle('d-none')
                vendor[index].classList.toggle('d-none')
            })
        })

        btnvendor.forEach((element,index) => {
            element.addEventListener('click', () => {
                pemilik[index].classList.toggle('d-none')
                vendor[index].classList.toggle('d-none')
            })
        })

    </script>
   
@endsection
