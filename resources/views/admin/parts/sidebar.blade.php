<div class="ecaps-sidemenu-area bg-img" style="background: #fff">
    <!-- Desktop Logo -->
    <div class="ecaps-logo">
        <a href="{{ route('adminDashboard') }}">
            <img class="desktop-logo" src="{{ asset('admin_src/img/core-img/logo.png') }}" alt="Desktop Logo">
            <img class="small-logo" src="{{ asset('admin_src/img/core-img/small-logo.png') }}" alt="Mobile Logo">
        </a>
    </div>

    @php
        $currentRoute = request()->route()->getName();
    @endphp

    <!-- Side Nav -->
    <div class="ecaps-sidenav" id="ecapsSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
            <!-- Sidebar Menu -->
            <nav>
                <ul class="sidebar-menu" data-widget="tree">
                    <li @if( $currentRoute === 'adminDashboard' ) class="active"@endif>
                        <a href="{{ route('adminDashboard') }}">
                            <i class='fa fa-home'></i>
                            <span>Головна</span>
                        </a>
                    </li>

                    {{-- <li class="treeview {{ in_array($currentRoute, [
                            'admin.car-common-settings.edit.page',
                            'admin.one.car.page',
                        ]) ? 'active' : '' }}">
                        <a href="javascript:void(0)">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.settings') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li @if( $currentRoute === 'admin.car-common-settings.edit.page' ) class="active"@endif><a href="{{ route('admin.car-common-settings.edit.page') }}">{{ trans('admin.car_common_settings') }}</a></li>
                        </ul>
                    </li> --}}


                </ul>
            </nav>
        </div>
    </div>
</div>
