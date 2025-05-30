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
                    {{-- <img src="{{ asset('admin_src/img/member-img/contact-2.jpg') }}" alt=""> --}}
                    <svg fill="#ff4d4d" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 520.349 520.349" xml:space="preserve" stroke="#ff4d4d">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                        <g id="SVGRepo_iconCarrier"> <g> <path d="M445.223,0H142.589c-6.683,0-12.105,5.423-12.105,12.105v180.979h16.65c-5.006-6.392-7.725-14.224-7.725-22.467 c-0.006-9.764,3.8-18.943,10.708-25.845c1.421-1.421,2.973-2.687,4.583-3.845V24.211h278.417v8.697l-127.104,92.285v395.155 l127.796-92.787c1.626,4.77,6.095,8.228,11.414,8.228c6.685,0,12.105-5.426,12.105-12.105V12.105 C457.328,5.417,451.907,0,445.223,0z M354.031,331.973c-5.71,0-10.468-7.046-11.691-16.485h-13.63v-10.592h13.819 c1.448-8.86,6.017-15.38,11.49-15.38c6.638,0,12.011,9.498,12.011,21.231C366.042,322.468,360.663,331.973,354.031,331.973z M150.122,314.471c1.424,1.412,2.967,2.678,4.572,3.824v105.389c0,6.68-5.426,12.105-12.105,12.105 c-6.683,0-12.105-5.426-12.105-12.105V266.139h16.65C135.948,280.466,136.935,301.271,150.122,314.471z M236.706,218.385 c4.817,4.817,4.817,12.608,0,17.425l-58.995,59.001c-2.403,2.394-5.556,3.605-8.709,3.611c-3.153-0.006-6.307-1.206-8.71-3.611 c-4.811-4.817-4.805-12.613,0-17.419l37.974-37.977H75.336c-6.803,0-12.315-5.512-12.315-12.315 c0-6.803,5.506-12.318,12.321-12.318h122.917l-37.968-37.974c-4.805-4.805-4.811-12.608,0-17.413 c4.812-4.812,12.614-4.812,17.425,0L236.706,218.385z"/> </g> </g>
                    </svg>
                </button>
                <div class="dropdown-menu profile dropdown-menu-right">
                    <!-- User Profile Area -->
                    <div class="user-profile-area">
                        {{--                        TODO: Add actions --}}

                        <form action="{{ route('auth.logout') }}" method="POST">
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
