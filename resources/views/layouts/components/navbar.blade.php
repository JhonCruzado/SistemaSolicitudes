<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl box-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item nav-search">
                    <a class="nav-link nav-link-search">
                        <i class="ficon" data-feather="search"></i>
                    </a>
                    <div class="search-input">
                        <div class="search-input-icon">
                            <i data-feather="search"></i>
                        </div>
                        <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1"
                            data-search="search">
                        <div class="search-input-close">
                            <i data-feather="x"></i>
                        </div>
                        <ul class="search-list search-list-main"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">

            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <span class="badge rounded-pill bg-primary badge-up">5</span>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder text-truncate">{{ Auth::user()->nombre }}</span>
                        <span class="user-status" style="color: #26a69a">{{ Auth::user()->roles->rol }}</span>
                    </div><span class="avatar">
                        <img class="round" src="{{ asset('images/default.jpg') }}" alt="avatar"
                            height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="me-50" data-feather="power"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->
