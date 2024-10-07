<header class="top-header-area d-flex align-items-center justify-content-between">
    <div class="left-side-content-area d-flex align-items-center">
        <!-- Mobile Logo -->
        <div class="mobile-logo mr-3 mr-sm-4">
            <a href="{{ route('adminDashboard') }}"><img src="{{ asset('admin_src/img/core-img/small-logo.png') }}"
                    alt="Mobile Logo"></a>
        </div>

        <!-- Triggers -->
        <div class="ecaps-triggers mr-1 mr-sm-3">
            <div class="menu-collasped" id="menuCollasped">
                <i class='bx bx-menu'></i>
            </div>
            <div class="mobile-menu-open" id="mobileMenuOpen">
                <i class='bx bx-menu'></i>
            </div>
        </div>
    </div>

    <div class="right-side-navbar d-flex align-items-center justify-content-end">
        <!-- Mobile Trigger -->
        <div class="right-side-trigger" id="rightSideTrigger">
            <i class='bx bx-menu-alt-right'></i>
        </div>

        <!-- Top Bar Nav -->
        <ul class="right-side-content d-flex align-items-center">

            <div>
                <x-admin.multilanguage-switch />
            </div>

            <li class="nav-item dropdown">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false"><span class="flag-thumb-cu">
                        {{-- <img src="img/core-img/l1.jpg"alt=""></span> --}}
                    </button>
                <div class="dropdown-menu language-dropdown dropdown-menu-right">
                    {{-- <a href="#" class="dropdown-item mb-15"><img
                            src="{{ asset('admin_src/img/core-img/l5.jpg') }}" alt="Image"> <span>USA</span></a> --}}
                    <a href="#" class="dropdown-item mb-15"><img
                            src="{{ asset('admin_src/img/core-img/l2.jpg') }}" alt="Image"> <span>German</span></a>
                    <a href="#" class="dropdown-item mb-15"><img
                            src="{{ asset('admin_src/img/core-img/l3.jpg') }}" alt="Image"> <span>Italian</span></a>
                    <a href="#" class="dropdown-item"><img src="{{ asset('admin_src/img/core-img/l4.jpg') }}"
                            alt="Image"> <span>Russian</span></a>
                </div>
            </li>


            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- Top Notifications Area -->
                    <div class="top-notifications-area">
                        <!-- Heading -->
                        <div class="notifications-heading">

                        </div>

                        <div class="slimScrollDiv"
                            style="position: relative; overflow-y: auto; width: auto; height: 260px;">
                            <div class="notifications-box d-none" id="notificationsBox"
                                style="width: auto; height: 260px;">

                            </div>
                        </div>
                    </div>
            </li>


            <li class="nav-item dropdown">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img src="{{ asset('admin_src/img/member-img/contact-2.jpg') }}" alt="">
                </button>
                <div class="dropdown-menu profile dropdown-menu-right">
                    <!-- User Profile Area -->
                    <div class="user-profile-area">
                        {{--                        TODO: Add actions --}}

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="dropdown-item"><i class="bx bx-power-off font-15"
                                    aria-hidden="true"></i>Вийти з системи</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
