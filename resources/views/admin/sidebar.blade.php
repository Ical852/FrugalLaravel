<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="/">
                    <img src="{{ asset('admin/images/logo.png') }}" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow" href="/administrator">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                    <a href="/admin/profile">
                        <i class="fas fa-user"></i>Profile</a>
                </li>
                <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
                    <a href="/admin/category">
                        <i class="fas fa-list"></i>Category</a>
                </li>
                <li class="{{ Request::is('admin/vendordata') ? 'active' : '' }}">
                    <a href="/admin/vendordata">
                        <i class="fas fa-shopping-bag"></i>Vendors</a>
                </li>
                <li class="{{ Request::is('admin/transaction') ? 'active' : '' }}">
                    <a href="/admin/transaction">
                        <i class="fas fa-credit-card"></i>Transaction</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="/">
            <img src="{{ asset('admin/images/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ Request::is('administrator') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="/administrator">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                    <a href="/admin/profile">
                        <i class="fas fa-user"></i>Profile</a>
                </li>
                <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
                    <a href="/admin/category">
                        <i class="fas fa-list"></i>Category</a>
                </li>
                <li class="{{ Request::is('admin/vendordata') ? 'active' : '' }}">
                    <a href="/admin/vendordata">
                        <i class="fas fa-shopping-bag"></i>Vendors</a>
                </li>
                <li class="{{ Request::is('admin/transaction') ? 'active' : '' }}">
                    <a href="/admin/transaction">
                        <i class="fas fa-credit-card"></i>Transaction</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
