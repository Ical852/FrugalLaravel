<!-- Header -->
<style>
    .shadowing {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        padding: 10px;
    }

</style>
<header class="header shop">
    <div class="middle-inner shadowing" id="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="/"><img src="{{ asset('admin/images/home.png') }}" alt="logo"
                                style="height: 32px; width:110px"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="" onclick="return false;"><i class="ti-search"></i></a>
                        </div>
                        <!-- Search Form -->
                        <div class="search-top" method="GET">
                            @if (Request::segment(1) == 'shop' and Request::segment(2) != 'detail')
                                <form class="search-form" method="GET">
                                    <input type="search" placeholder="Search here..." name="search">
                                    <button value="search" type="submit"><i class="ti-search"></i></button>
                                </form>
                            @else
                                <form class="search-form" method="GET" action="/shop">
                                    <input type="search" placeholder="Search here..." name="search">
                                    <button value="search" type="submit"><i class="ti-search"></i></button>
                                </form>
                            @endif

                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select id="select-category">
                                <option disabled="disabled" selected="true">Category</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c->slug }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @if (Request::segment(1) == 'shop' and Request::segment(2) != 'detail')
                                <form method="GET">
                                    <input name="search" placeholder="Search Products Here....." type="search">
                                    <button class="btnn"><i class="ti-search"
                                            style="color: white;"></i></button>
                                </form>
                            @else
                                <form method="GET" action="/shop">
                                    <input name="search" placeholder="Search Products Here....." type="search">
                                    <button class="btnn"><i class="ti-search"
                                            style="color: white;"></i></button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        @guest
                            <div class="sinlge-bar">
                                <a href="/auth" class="single-icon" style="font-size: 20px"><i class="fa fa-sign-in"
                                        aria-hidden="true"></i> Masuk</a>
                            </div>
                        @endguest

                        @auth
                            <div class="sinlge-bar shopping">
                                <a href="/user" class="single-icon"><i class="ti-user"></i></a>
                                <!-- Shopping Item -->
                                @if (auth()->user()->role == 'admin')
                                    <div class="shopping-item">
                                        <div class="bottom">
                                            <a href="/admin/profile" class="btn animate">My Profile</a>
                                            <a href="/administrator" class="btn animate">Dashboard</a>
                                        </div>
                                    </div>
                                @elseif(auth()->user()->role == 'vendor')
                                    <div class="shopping-item">
                                        <div class="bottom">
                                            <a href="/vendor/profile" class="btn animate">My Profile</a>
                                            <a href="/vendorpage" class="btn animate">Toko</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="shopping-item">
                                        <div class="bottom">
                                            <a href="/user" class="btn animate">My Profile</a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="sinlge-bar shopping">
                                <a href="/user/cart" class="single-icon"><i class="ti-bag"></i>
                                    @if (!$check)

                                    @else
                                        <span class="total-count">{{ count($cart) }}</span>
                                    @endif
                                </a>
                                <!-- Shopping Item -->
                                @if (!$check)

                                @else
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{ count($cart) }} Items</span>
                                            <a href="/user/cart">View Cart</a>
                                        </div>

                                        @php
                                            $total = 0;
                                        @endphp

                                        @foreach ($cart as $c)
                                            <ul class="shopping-list">
                                                <li>
                                                    <a class="cart-img" href onclick="return false;">
                                                        <img src="{{ asset('storage/' . $c->product->image) }}"
                                                            style="height: 70px; wdith:70px;">
                                                    </a>
                                                    <h4><a href onclick="return false;">{{ $c->product->name }}</a></h4>
                                                    <p class="quantity">{{ $c->qty }} - <span
                                                            class="amount">Rp.
                                                            {{ number_format($c->qty * $c->product->price) }} </span></p>
                                                </li>
                                            </ul>
                                            @php
                                                $total += $c->product->price * $c->qty;
                                            @endphp
                                        @endforeach

                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">Rp. {{ number_format($total) }} </span>
                                            </div>
                                            <form action="/user/checkout" method="post">
                                                @csrf
                                                <button type="submit" class="btn animate"
                                                    onclick="return confirm('checkout ?')">Checkout</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                <!--/ End Shopping Item -->
                            </div>

                            <div class="sinlge-bar">
                                <a href="/user/payment" class="single-icon"><i class="ti-shopping-cart-full"
                                        aria-hidden="true"></i></a>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner shadowing">
        <div class="container-fluid">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="/"><img src="{{ asset('admin/images/home.png') }}" alt="logo"
                                    style="height: 32px; width:110px"></a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search"><a href="" onclick="return false;"><i class="ti-search"
                                        style="color: white;"></i></a>
                            </div>
                            <!-- Search Form -->
                            <div class="search-top" method="GET">
                                @if (Request::segment(1) == 'shop' and Request::segment(2) != 'detail')
                                    <form class="search-form" method="GET">
                                        <input type="search" placeholder="Search here..." name="search">
                                        <button value="search" type="submit"><i class="ti-search"
                                                style="color: white;"></i></button>
                                    </form>
                                @else
                                    <form class="search-form" method="GET" action="/shop">
                                        <input type="search" placeholder="Search here..." name="search">
                                        <button value="search" type="submit"><i class="ti-search"
                                                style="color: white;"></i></button>
                                    </form>
                                @endif

                            </div>
                            <!--/ End Search Form -->
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <div class="col-lg-7 col-md-5">
                        <div class="search-bar-top">
                            <div class="search-bar" style="width: 100%">
                                @if (Request::segment(1) == 'shop' and Request::segment(2) != 'detail')
                                    <form method="GET" style="width: 100%">
                                        <input name="search" placeholder="Search Products Here....." type="search"
                                            style="width: 100%; border:none; outline:none;">
                                        <button class="btnn"><i class="ti-search"
                                                style="color: white;"></i></button>
                                    </form>
                                @else
                                    <form method="GET" action="/shop" style="width: 100%">
                                        <input name="search" placeholder="Search Products Here....." type="search"
                                            style="width: 100%; border:none; outline:none;">
                                        <button class="btnn"><i class="ti-search"
                                                style="color: white;"></i></button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 d-none" id="mobf">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li><a href="/">Home</a></li>
                                            <li><a href="/shop">Shop</a></li>
                                            @guest
                                                <li><a href="/auth">Masuk</a></li>
                                            @endguest
                                            @auth
                                                @if (auth()->user()->role == 'admin')
                                                    <li><a href="/admin/profile">My Profile</a></li>
                                                    <li><a href="/admin">Dashboard</a></li>
                                                @elseif(auth()->user()->role == 'vendor')
                                                    <li><a href="/vendor/profile">My Profile</a></li>
                                                    <li><a href="/vendorpage">Toko</a></li>
                                                @else
                                                    <li><a href="/user">My Profile</a></li>
                                                @endif
                                                    <li><a href="/user/cart">Cart</a></li>
                                                    <li><a href="/user/payment">Pesanan</a></li>
                                                    <li><a href="/user/whistlist">Whistlist</a></li>
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="right-bar">
                            <!-- Search Form -->
                            @guest
                                <div class="sinlge-bar">
                                    <a href="/auth" class="single-icon" style="font-size: 20px"><i class="ti-shift-right"
                                            aria-hidden="true"></i> Masuk</a>
                                </div>
                            @endguest

                            @auth
                                <div class="sinlge-bar shopping">
                                    @if (auth()->user()->role == 'admin')
                                        <a href="/admin/profile" class="single-icon"><i class="ti-user"></i></a>
                                    @elseif(auth()->user()->role == 'vendor')
                                        <a href="/vendor/profile" class="single-icon"><i class="ti-user"></i></a>
                                    @else
                                        <a href="/user" class="single-icon"><i class="ti-user"></i></a>
                                    @endif
                                    <!-- Shopping Item -->
                                    @if (auth()->user()->role == 'admin')
                                        <div class="shopping-item">
                                            <div class="bottom">
                                                <a href="/admin/profile" class="btn animate">My Profile</a>
                                                <a href="/administrator" class="btn animate">Dashboard</a>
                                            </div>
                                        </div>
                                    @elseif(auth()->user()->role == 'vendor')
                                        <div class="shopping-item">
                                            <div class="bottom">
                                                <a href="/vendor/profile" class="btn animate">My Profile</a>
                                                <a href="/vendorpage" class="btn animate">Toko</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="shopping-item">
                                            <div class="bottom">
                                                <a href="/user" class="btn animate">My Profile</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="sinlge-bar shopping">
                                    <a href="/user/cart" class="single-icon"><i class="ti-bag"></i>
                                        @if (!$check)

                                        @else
                                            <span class="total-count">{{ count($cart) }}</span>
                                        @endif
                                    </a>
                                    <!-- Shopping Item -->
                                    @if (!$check)

                                    @else
                                        <div class="shopping-item">
                                            <div class="dropdown-cart-header">
                                                <span>{{ count($cart) }} Items</span>
                                                <a href="/user/cart">View Cart</a>
                                            </div>

                                            @php
                                                $total = 0;
                                            @endphp

                                            @foreach ($cart as $c)
                                                <ul class="shopping-list">
                                                    <li>
                                                        <a class="cart-img" href onclick="return false;">
                                                            <img src="{{ asset('storage/' . $c->product->image) }}"
                                                                style="height: 70px; wdith:70px;">
                                                        </a>
                                                        <h4><a href onclick="return false;">{{ $c->product->name }}</a>
                                                        </h4>
                                                        <p class="quantity">{{ $c->qty }} - <span
                                                                class="amount">Rp.
                                                                {{ number_format($c->qty * $c->product->price) }} </span>
                                                        </p>
                                                    </li>
                                                </ul>
                                                @php
                                                    $total += $c->product->price * $c->qty;
                                                @endphp
                                            @endforeach

                                            <div class="bottom">
                                                <div class="total">
                                                    <span>Total</span>
                                                    <span class="total-amount">Rp. {{ number_format($total) }} </span>
                                                </div>
                                                <form action="/user/checkout" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn animate"
                                                        onclick="return confirm('checkout ?')">Checkout</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif

                                    <!--/ End Shopping Item -->
                                </div>

                                <div class="sinlge-bar">
                                    <a href="/user/whistlist" class="single-icon"><i class="ti-heart"
                                            aria-hidden="true"></i></a>
                                </div>

                                <div class="sinlge-bar">
                                    <a href="/user/payment" class="single-icon"><i class="ti-shopping-cart-full"
                                            aria-hidden="true"></i></a>
                                </div>
                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
<script type="text/javascript">
    const category = document.getElementById('select-category')
    category.onchange = function() {
        const val = category.value
        axios.get(`/shop/category/${val}`)
            .then(function(response) {
                //console.log(response);
                window.location.href = `/shop/category/${val}`
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    const middlehead = document.getElementById('middle-inner')
    const dropdown = document.getElementById('mobf')

    window.addEventListener("resize", function() {
        if (window.innerWidth < 768) {
            middlehead.classList.remove('d-none')
            dropdown.classList.remove('d-none')
        } else {
            middlehead.classList.add('d-none')
            dropdown.classList.add('d-none')
        }
    });

    if (window.innerWidth < 768) {
        middlehead.classList.remove('d-none')
        dropdown.classList.remove('d-none')
    } else {
        middlehead.classList.add('d-none')
        dropdown.classList.add('d-none')
    }
</script>
