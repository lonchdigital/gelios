<div class="ecaps-sidemenu-area bg-img" style="background: #fff">
    <!-- Desktop Logo -->
    <div class="ecaps-logo">
        <a href="{{ route('adminDashboard') }}">
            <img class="desktop-logo" src="{{ asset('admin_src/img/core-img/logo.png') }}" alt="Desktop Logo">
            <img class="small-logo" src="{{ asset('admin_src/img/core-img/small-logo.png') }}" alt="Mobile Logo">
        </a>
    </div>

    <!-- Side Nav -->
    <div class="ecaps-sidenav" id="ecapsSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
            <!-- Sidebar Menu -->
            <nav>
                <ul class="sidebar-menu" data-widget="tree">
                    <li @if( Route::is('adminDashboard') ) class="active"@endif>
                        <a href="{{ route('adminDashboard') }}">
                            <i class='fa fa-home'></i>
                            <span>{{ trans('admin.main') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('directions.index') ) class="active"@endif>
                        <a href="{{ route('directions.index') }}">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.directions') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('insurance.companies.index') ) class="active"@endif>
                        <a href="{{ route('insurance.companies.index') }}">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.insurance_companies') }}</span>
                        </a>
                    </li>

                    <li @if(Route::is('admin.promotions.*')) class="active" @endif>
                        <a href="{{ route('admin.promotions.index') }}">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.promotions') }}</span>
                        </a>
                    </li>

                    <li @if(Route::is('admin.check-ups.*')) class="active" @endif>
                        <a href="{{ route('admin.check-ups.index') }}">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.check_ups') }}</span>
                        </a>
                    </li>

                    <li class="treeview @if(Route::is('admin.article-categories.*') || Route::is('admin.articles.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="bx bx-home-heart"></i> <span>{{ trans('admin.articles') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.article-categories.*') || Route::is('admin.articles.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.article-categories.*')) class="active" @endif>
                                <a href="{{ route('admin.article-categories.index') }}">{{ trans('admin.categories') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.*')) class="active" @endif >
                                <a href="{{ route('admin.articles.index') }}">{{ trans('admin.articles_list') }}

                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
