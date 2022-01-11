<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('vendorpage') ? 'active' : '' }}" href="/vendorpage">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('vendor/profile') ? 'active' : '' }} }}" href="/vendor/profile">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('yourmarket') ? 'active' : '' }}" href="/yourmarket">
                <i class="ti-shopping-cart menu-icon"></i>
                <span class="menu-title">Toko Anda</span>
            </a>
        </li>
    </ul>
</nav>
