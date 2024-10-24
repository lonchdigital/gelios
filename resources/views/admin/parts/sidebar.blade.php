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

                    <li class="treeview @if(Route::is('directions.*')) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-sitemap"></i>
                            <span>{{ trans('admin.directions') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('directions.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('directions.page.edit')) class="active" @endif>
                                <a href="{{ route('directions.page.edit') }}">{{ trans('admin.directions_page') }}</a>
                            </li>
                            <li @if(Route::is('directions.index')) class="active" @endif >
                                <a href="{{ route('directions.index') }}">{{ trans('admin.directions') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li @if( Route::is('hospitals.index') ) class="active"@endif>
                        <a href="{{ route('hospitals.index') }}">
                            <i class='fa fa-h-square'></i>
                            <span>{{ trans('admin.hospitals_stationary') }}</span>
                        </a>
                    </li>

                    <li class="treeview @if(Route::is('prices.*')) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-usd"></i>
                            <span>{{ trans('admin.prices') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('prices.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::PRICES->value)->first()->id) class="active" @endif>
                                <a href="{{ route('prices.index', ['page' => App\Models\Page::where('type', App\Enums\PageType::PRICES->value)->first()]) }}">{{ trans('admin.prices') }}</a>
                            </li>
                            <li @if(Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::LABORATORY->value)->first()->id) class="active" @endif>
                                <a href="{{ route('prices.index', ['page' => App\Models\Page::where('type', App\Enums\PageType::LABORATORY->value)->first()]) }}">{{ trans('admin.laboratories') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li @if( Route::is('contacts.index') ) class="active"@endif>
                        <a href="{{ route('contacts.index') }}">
                            <i class='fa fa-address-card'></i>
                            <span>{{ trans('admin.contacts') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('offices.index') ) class="active"@endif>
                        <a href="{{ route('offices.index') }}">
                            <i class='fa fa-building-o'></i>
                            <span>{{ trans('admin.offices') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('text.pages.index') ) class="active"@endif>
                        <a href="{{ route('text.pages.index') }}">
                            <i class='fa fa-file-text-o'></i>
                            <span>{{ trans('admin.text_pages') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('typical.pages.index') ) class="active"@endif>
                        <a href="{{ route('typical.pages.index') }}">
                            <i class='fa fa-file-text-o'></i>
                            <span>{{ trans('admin.typical_pages') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('about.us.edit') ) class="active"@endif>
                        <a href="{{ route('about.us.edit') }}">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.about_us') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('insurance.companies.index') ) class="active"@endif>
                        <a href="{{ route('insurance.companies.index') }}">
                            <i class='fa fa-briefcase'></i>
                            <span>{{ trans('admin.insurance_companies') }}</span>
                        </a>
                    </li>

                    <li @if( Route::is('one.center.show') ) class="active"@endif>
                        <a href="{{ route('one.center.show') }}">
                            <i class='fa fa-building-o'></i>
                            <span>{{ trans('admin.one_center') }}</span>
                        </a>
                    </li>

                    <li class="treeview @if(Route::is('reviews.*')) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-commenting-o"></i>
                            <span>{{ trans('admin.reviews') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('reviews.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('reviews.index')) class="active" @endif>
                                <a href="{{ route('reviews.index') }}">{{ trans('admin.reviews') }}</a>
                            </li>
                            {{-- <li @if(Route::is('directions.index')) class="active" @endif >
                                <a href="{{ route('directions.index') }}">{{ trans('admin.directions') }}</a>
                            </li> --}}
                        </ul>
                    </li>

                    <li @if(Route::is('admin.promotions.*')) class="active" @endif>
                        <a href="{{ route('admin.promotions.index') }}">
                            <i class="fa fa-star-o"></i>
                            <span>{{ trans('admin.promotions') }}</span>
                        </a>
                    </li>

                    <li @if(Route::is('admin.check-ups.*')) class="active" @endif>
                        <a href="{{ route('admin.check-ups.index') }}">
                            <i class="fa fa-check-circle-o"></i>
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

                    <li class="treeview @if(Route::is('admin.doctor-categories.*') || Route::is('admin.doctors.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-user-md"></i> <span>Лікарі</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.doctor-categories.*') || Route::is('admin.doctors.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.doctor-categories.*')) class="active" @endif>
                                <a href="{{ route('admin.doctor-categories.index') }}">Категорії
                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.*')) class="active" @endif >
                                <a href="{{ route('admin.doctors.index') }}">Список лікарів

                                </a>
                            </li>
                        </ul>
                    </li>

                    <li @if(Route::is('admin.specializations.*')) class="active" @endif>
                        <a href="{{ route('admin.specializations.index') }}">
                            <i class="fa fa-stethoscope"></i>
                            <span>Спеціальності лікарів</span>
                        </a>
                    </li>

                    <li class="treeview @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-hospital-o"></i> <span>Лабораторії</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.laboratory-cities.*')) class="active" @endif>
                                <a href="{{ route('admin.laboratory-cities.index') }}">Міста лабораторій
                                </a>
                            </li>
                            <li @if(Route::is('admin.laboratories.*')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.index') }}">Список лабораторій
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li @if(Route::is('admin.surgery.*')) class="active" @endif>
                        <a href="{{ route('admin.surgery.index') }}">
                            <i class="fa fa-medkit"></i>
                            <span>Хірургія</span>
                        </a>
                    </li>

                    <li @if(Route::is('admin.vacancies.*')) class="active" @endif>
                        <a href="{{ route('admin.vacancies.index') }}">
                            <i class="fa fa-address-book-o"></i>
                            <span>Вакансії</span>
                        </a>
                    </li>

                    <li @if(Route::is('admin.edit-robots')) class="active" @endif>
                        <a href="{{ route('admin.edit-robots') }}">
                            <i class="fa fa-file-code-o"></i>
                            <span>Robots.txt</span>
                        </a>
                    </li>

                    <li class="treeview @if(
                        Route::is('admin.main-page.*')
                        || Route::is('admin.main-page.*')
                    ) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-hospital-o"></i> <span>Сторінки</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.main-page.*')) class="active" @endif>
                                <a href="{{ route('admin.main-page.show') }}">Головна сторінка
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
