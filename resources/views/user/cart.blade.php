@extends('main')
@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs" style="padding: 20px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list text-white">
                            <li><a href="/" class="text-white">Home<i class="ti-arrow-right text-white"></i></a></li>
                            <li class="active">Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shopping Cart -->
    <div class="shopping-cart section " style="padding-bottom: 200px">
        <div class="container">
            <div class="row">
                <div class="col-12">

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

                    

                    <table class="table shopping-summery">
                        <thead style="padding: 20px; background: linear-gradient(to left, #013a20 0%, #478c5c 100%);">
                            <tr class="main-hading">
                                <th>PRODUCT</th>
                                <th>NAME</th>
                                <th class="text-center">UNIT PRICE</th>
                                <th class="text-center">QUANTITY</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center">CANCEL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$check)
                                <td colspan="6" class="text-center">Belum ada cart</td>
                            @else
                            @foreach ($cart as $c)
                                <tr>
                                    <td class="image" data-title="No">
                                        <img src="{{ asset('storage/'. $c->product->image) }}" style="height: 80px; width:80px;">
                                    </td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="" onclick="return false;">{{ $c->product->name }}</a></p>
                                        <p class="product-des">{{ $c->product->description }}
                                        </p>
                                    </td>
                                    <td class="price" data-title="Price"><span>Rp. {{ number_format($c->product->price) }}</span></td>
                                    <td class="qty" data-title="Qty">
                                        <!-- Input Order -->
                                        <div class="input-group" style="width: 100%">
                                            
                                            <input type="number" name="qty{{ $c->id }}" class="input-number counterqty" data-min="1"
                                                data-max="{{ $c->product->qty }}" value="{{ $c->qty }}" data-item="{{ $c->id }}" style="width: 100%">
                                            
                                        </div>
                                        <!--/ End Input Order -->
                                    </td>
                                    <td class="total-amount" data-title="Total"><span>Rp. {{ number_format($c->product->price * $c->qty) }}</span></td>
                                    <td class="action" data-title="Remove">
                                        <form action="/user/cartdelete/{{ $c->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn" type="submit" onclick="return confirm('Anda yakin cancel?')">
                                                <i class="ti-trash remove-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach

                            @endif
                            
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    @if (!$check)
                                        
                                    @else
                                        @if (session()->has('address'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('address') }}
                                            </div>
                                        @endif

                                        <div class="coupon">
                                            <form action="/user/address" method="POST">
                                                @csrf
                                                <div>
                                                    <input class="is-invalid" value="{{ $address ? $address->name : '' }}" name="name" placeholder="Masukkan Alamat Anda" @error('name') autofocus @enderror
                                                    @if (session()->has('address'))
                                                        autofocus
                                                    @endif required>
                                                    <button class="btn" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    @if (!$check)
                                        <div class="button5">
                                            <a href="/shop" class="btn">Continue shopping</a>
                                        </div>
                                    @else
                                        <ul>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($cart as $c)
                                                <li>{{ $c->product->name }}<span>Rp. {{ number_format($c->product->price * $c->qty) }}</span></li>
                                                @php
                                                    $total += $c->product->price * $c->qty;
                                                @endphp
                                            @endforeach
                                            
                                            
                                            <li class="last">Total<span>Rp. {{ number_format($total) }}</span></li>
                                        </ul>
                                        <div class="button5">
                                            <form action="/user/checkout" method="post">
                                                @csrf
                                                <button type="submit" class="btn">Checkout</button>
                                            </form>
                                            <a href="/shop" class="btn">Continue shopping</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

    <script type="text/javascript">
            const classname = document.querySelectorAll('.counterqty');

            classname.forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-item');
                    const max = element.getAttribute('data-max');
                    const min = element.getAttribute('data-min');
                    if(parseInt(element.value) > max) {
                        alert('Ups')
                    } else if(parseInt(element.value) < min) {
                        alert('Ups')
                    } else {
                        axios.patch(`/user/updatecart`, {
                            qty: element.value,
                            id: id
                        })
                        .then(function(response) {
                            //console.log(response);
                            window.location.href = '/user/cart'
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    }
                })
            })

    </script>

@endsection
