<div class="ecaps-sidemenu-area bg-img" style="background: #fff">
    <!-- Desktop Logo -->
    <div class="ecaps-logo">
        <a href="{{ route('adminDashboard') }}">
            <img class="desktop-logo" src="{{ asset('admin_src/img/core-img/dashboard_logo.png') }}" alt="Desktop Logo">
            <img class="small-logo" src="{{ asset('static_images/logo-without-name.png') }}" alt="Mobile Logo">
        </a>
    </div>

    <!-- Side Nav -->
    <div class="ecaps-sidenav" id="ecapsSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
            <!-- Sidebar Menu -->
            <nav>
                <ul class="sidebar-menu" data-widget="tree">
                    <li @if(Route::is('admin.lead-apps.index')) class="active" @endif>
                        <a href="{{ route('admin.lead-apps.index') }}"><i class='fa fa-file-text-o'></i>
                            <span style="text-transform: lowercase;">
                                <span style="text-transform: uppercase;">{{ mb_substr(__('admin.lead_applications'), 0, 1) }}</span>{{ mb_substr(__('admin.lead_applications'), 1) }}
                            </span>
                        </a>
                    </li>
                    <li @if(Route::is('admin.vacancy-apps.index')) class="active" @endif>
                        <a href="{{ route('admin.vacancy-apps.index') }}">
                            <i class="fa fa-address-book-o"></i>
                            <span style="text-transform: lowercase;">
                                <span style="text-transform: uppercase;">{{ mb_substr(__('admin.application_for_vacancies'), 0, 1) }}</span>{{ mb_substr(__('admin.application_for_vacancies'), 1) }}
                            </span>
                        </a>
                    </li>
                    <li class=" @if(Route::is('admin.pages.*')) active @endif">
                        <a href="{{ route('admin.pages.index') }}"><i class='fa fa-file-text-o'></i>
                            <span>
                                {{ __('admin.pages2') }}
                            </span>
                        </a>
                    </li>

                    <li class="treeview @if(Route::is('directions.*') ||
                                            Route::is('common-blocks.directions') ||
                                            ( Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::PRICES->value)->first()->id )
                                            ) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-sitemap"></i>
                            <span>{{ trans('admin.directions') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('directions.*') ||
                                                      Route::is('common-blocks.directions') ||
                                                      ( Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::PRICES->value)->first()->id )
                                                    ) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('directions.page.edit')) class="active" @endif>
                                <a href="{{ route('directions.page.edit') }}">
                                    {{-- {{ trans('admin.directions_page') }} --}}
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(trans('admin.directions_page'), 0, 1) }}</span>{{ mb_substr(trans('admin.directions_page'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('directions.index')) class="active" @endif >
                                <a href="{{ route('directions.index') }}">{{ trans('admin.directions') }}</a>
                            </li>
                            <li @if(Route::is('common-blocks.directions')) class="active" @endif>
                                <a href="{{ route('common-blocks.directions') }}">
                                    {{-- {{ trans('admin.directions_common_blocks') }} --}}
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(trans('admin.directions_common_blocks'), 0, 1) }}</span>{{ mb_substr(trans('admin.directions_common_blocks'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::PRICES->value)->first()->id) class="active" @endif>
                                <a href="{{ route('prices.index', ['page' => App\Models\Page::where('type', App\Enums\PageType::PRICES->value)->first()]) }}">{{ trans('admin.prices') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li @if( Route::is('one.center.index') ) class="active"@endif>
                        <a href="{{ route('one.center.index') }}">
                            <i class='fa fa-building-o'></i>
                            {{-- <span>{{ trans('admin.all_centers') }}</span> --}}
                            <span style="text-transform: lowercase;">
                                <span style="text-transform: uppercase;">{{ mb_substr(trans('admin.all_centers'), 0, 1) }}</span>{{ mb_substr(trans('admin.all_centers'), 1) }}
                            </span>
                        </a>
                    </li>

                    {{-- <li class=" @if(Route::is('admin.laboratories.*')) active @endif">
                        <a href="{{ route('admin.laboratories-page.index') }}"><i class="fa fa-hospital-o"></i>
                            <span>
                                {{ __('admin.laboratories') }}
                            </span>
                        </a>
                    </li> --}}
                    <li class="treeview @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-hospital-o"></i>
                            <span>
                                {{ __('admin.laboratories') }}
                            </span>
                                <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.laboratories.index') || Route::is('admin.laboratories.create') || Route::is('admin.laboratories.edit')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.laboratories_list'), 0, 1) }}</span>{{ mb_substr(__('admin.laboratories_list'), 1) }}
                                    </span>
                                </a>
                            </li>

                            <li @if(Route::is('admin.laboratories.prices.*')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.prices.index') }}">{{ __('admin.prices') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class=" @if(Route::is('admin.doctors.*')) active @endif">
                        <a href="{{ route('admin.doctors-page.index') }}"><i class="fa fa-user-md"></i>
                            <span>
                                {{ __('admin.doctors') }}
                            </span>
                        </a>
                    </li> --}}

                    <li class="treeview @if(Route::is('admin.doctor-categories.*') || Route::is('admin.doctors.*') || Route::is('admin.specializations.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-user-md"></i> <span>{{ __('admin.doctors') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.doctor-categories.*') || Route::is('admin.doctors.*')  || Route::is('admin.specializations.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.doctor-categories.*')) class="active" @endif>
                                <a href="{{ route('admin.doctor-categories.index') }}">{{ __('admin.categories') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.specializations.*')) class="active" @endif>
                                <a href="{{ route('admin.specializations.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.specializations_of_doctors'), 0, 1) }}</span>{{ mb_substr(__('admin.specializations_of_doctors'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.index') || Route::is('admin.doctors.create') || Route::is('admin.doctors.edit')) class="active" @endif >
                                <a href="{{ route('admin.doctors.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.doctors_list'), 0, 1) }}</span>{{ mb_substr(__('admin.doctors_list'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.doctors.edit-main-seo') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.seo_doctors_page'), 0, 3) }}</span>{{ mb_substr(__('admin.seo_doctors_page'), 3) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.doctors.edit-one-page-seo') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.one_doctor_seo_page'), 0, 3) }}</span>{{ mb_substr(__('admin.one_doctor_seo_page'), 3) }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class=" @if(Route::is('admin.surgery.*')) active @endif">
                        <a href="{{ route('admin.surgery.index') }}"><i class="fa fa-medkit"></i>
                            <span>
                                {{ __('admin.surgery') }}
                            </span>
                        </a>
                    </li>

                    {{-- <li class=" @if(Route::is('admin.articles.*')) active @endif">
                        <a href="{{ route('admin.articles-page.index') }}"><i class="bx bx-home-heart"></i>
                            <span>
                                {{ __('admin.articles') }}
                            </span>
                        </a>
                    </li> --}}
                    <li class="treeview @if(Route::is('admin.article-categories.*') || Route::is('admin.articles.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="bx bx-home-heart"></i> <span>{{ trans('admin.articles') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.article-categories.*') || Route::is('admin.articles.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.article-categories.*')) class="active" @endif>
                                <a href="{{ route('admin.article-categories.index') }}">{{ trans('admin.categories') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.index') || Route::is('admin.articles.create') || Route::is('admin.articles.edit')) class="active" @endif >
                                <a href="{{ route('admin.articles.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(trans('admin.articles_list'), 0, 1) }}</span>{{ mb_substr(trans('admin.articles_list'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.articles.edit-main-seo') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.blog_seo'), 0, 1) }}</span>{{ mb_substr(__('admin.blog_seo'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.articles.edit-one-page-seo') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.one_article_seo'), 0, 1) }}</span>{{ mb_substr(__('admin.one_article_seo'), 1) }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class=" @if(Route::is('admin.promotions.*')) active @endif">
                        <a href="{{ route('admin.promotions.index') }}"><i class="fa fa-star-o"></i>
                            <span>
                                {{ __('admin.promotions') }}
                            </span>
                        </a>
                    </li>

                    <li class=" @if(Route::is('admin.check-ups.*')) active @endif">
                        <a href="{{ route('admin.check-ups.index') }}"><i class="fa fa-check-circle-o"></i>
                            <span>
                                {{ trans('admin.check_ups') }}
                            </span>
                        </a>
                    </li>

                    {{-- <li class=" @if(Route::is('admin.reviews.*')) active @endif">
                        <a href="{{ route('admin.reviews-page.index') }}"><i class="fa fa-commenting-o"></i>
                            <span>
                                {{ trans('admin.reviews') }}
                            </span>
                        </a>
                    </li> --}}
                    <li class="treeview @if(Route::is('reviews.*')) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-commenting-o"></i>
                            <span>{{ trans('admin.reviews') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if( Route::is('reviews.*') || Route::is('unpublished.reviews.index') ) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('reviews.page.edit')) class="active" @endif>
                                <a href="{{ route('reviews.page.edit') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(trans('admin.reviews_page'), 0, 1) }}</span>{{ mb_substr(trans('admin.reviews_page'), 1) }}
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('reviews.index')) class="active" @endif>
                                <a href="{{ route('reviews.index') }}">{{ trans('admin.reviews') }}</a>
                            </li>
                            <li @if(Route::is('unpublished.reviews.index')) class="active" @endif >
                                <a href="{{ route('unpublished.reviews.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(trans('admin.unpublished_reviews'), 0, 1) }}</span>{{ mb_substr(trans('admin.unpublished_reviews'), 1) }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class=" @if(Route::is('admin.vacancies.*')) active @endif">
                        <a href="{{ route('admin.vacancies-page.index') }}"><i class="fa fa-address-book-o"></i>
                            <span>
                                {{ __('admin.vacancy') }}
                            </span>
                        </a>
                    </li> --}}

                    <li class=" @if(Route::is('admin.vacancies.*')) active @endif">
                        <a href="{{ route('admin.vacancies.index') }}"><i class="fa fa-address-book-o"></i>
                            <span>
                                {{ __('admin.vacancy') }}
                            </span>
                        </a>
                    </li>


                    <!-- OLD MENU


                    -->

                    {{-- <li class="treeview @if(Route::is('directions.*')) menu-open @endif">
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
                    </li> --}}

                    {{-- <li @if( Route::is('hospitals.index') ) class="active"@endif>
                        <a href="{{ route('hospitals.index') }}">
                            <i class='fa fa-h-square'></i>
                            <span>{{ trans('admin.hospitals_stationary') }}</span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::LABORATORY->value)->first()->id) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-usd"></i>
                            <span>{{ trans('admin.prices') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::LABORATORY->value)->first()->id) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('prices.index') && request()->route('page')->id === App\Models\Page::where('type', App\Enums\PageType::LABORATORY->value)->first()->id) class="active" @endif>
                                <a href="{{ route('prices.index', ['page' => App\Models\Page::where('type', App\Enums\PageType::LABORATORY->value)->first()]) }}">{{ trans('admin.laboratories') }}</a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li @if( Route::is('contacts.index') ) class="active"@endif>
                        <a href="{{ route('contacts.index') }}">
                            <i class='fa fa-address-card'></i>
                            <span>{{ trans('admin.contacts') }}</span>
                        </a>
                    </li> --}}

                    {{-- <li @if( Route::is('offices.index') ) class="active"@endif>
                        <a href="{{ route('offices.index') }}">
                            <i class='fa fa-building-o'></i>
                            <span>{{ trans('admin.offices') }}</span>
                        </a>
                    </li> --}}

                    {{-- <li @if( Route::is('text.pages.index') ) class="active"@endif>
                        <a href="{{ route('text.pages.index') }}">
                            <i class='fa fa-file-text-o'></i>
                            <span>{{ trans('admin.text_pages') }}</span>
                        </a>
                    </li> --}}

                    <li @if( Route::is('typical.pages.index') ) class="active"@endif>
                        <a href="{{ route('typical.pages.index') }}">
                            <i class='fa fa-file-text-o'></i>
                            <span style="text-transform: lowercase;">
                                <span style="text-transform: uppercase;">{{ mb_substr(__('admin.typical_pages'), 0, 1) }}</span>{{ mb_substr(__('admin.typical_pages'), 1) }}
                            </span>
                        </a>
                    </li>

                    {{-- <li @if( Route::is('about.us.edit') ) class="active"@endif>
                        <a href="{{ route('about.us.edit') }}">
                            <i class='fa fa-cog'></i>
                            <span>{{ trans('admin.about_us') }}</span>
                        </a>
                    </li> --}}



                    {{-- <li class="treeview @if(Route::is('insurance.companies.*')) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class='fa fa-briefcase'></i>
                            <span>{{ trans('admin.insurance_companies') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if( Route::is('insurance.companies.*') ) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('insurance.companies.page.edit')) class="active" @endif>
                                <a href="{{ route('insurance.companies.page.edit') }}">{{ trans('admin.insurance_companies_page') }}</a>
                            </li>
                            <li @if(Route::is('insurance.companies.index')) class="active" @endif>
                                <a href="{{ route('insurance.companies.index') }}">{{ trans('admin.insurance_companies') }}</a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li @if( Route::is('one.center.index') ) class="active"@endif>
                        <a href="{{ route('one.center.index') }}">
                            <i class='fa fa-building-o'></i>
                            <span>{{ trans('admin.all_centers') }}</span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('reviews.*')) menu-open @endif">
                        <a href="javascript:void(0)">
                            <i class="fa fa-commenting-o"></i>
                            <span>{{ trans('admin.reviews') }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if( Route::is('reviews.*') || Route::is('unpublished.reviews.index') ) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('reviews.page.edit')) class="active" @endif>
                                <a href="{{ route('reviews.page.edit') }}">{{ trans('admin.reviews_page') }}</a>
                            </li>
                            <li @if(Route::is('reviews.index')) class="active" @endif>
                                <a href="{{ route('reviews.index') }}">{{ trans('admin.reviews') }}</a>
                            </li>
                            <li @if(Route::is('unpublished.reviews.index')) class="active" @endif >
                                <a href="{{ route('unpublished.reviews.index') }}">{{ trans('admin.unpublished_reviews') }}</a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li @if(Route::is('admin.promotions.*')) class="active" @endif>
                        <a href="{{ route('admin.promotions.index') }}">
                            <i class="fa fa-star-o"></i>
                            <span>{{ trans('admin.promotions') }}</span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.promotions.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-star-o"></i> <span>{{ trans('admin.promotions') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.promotions.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.promotions.index')) class="active" @endif>
                                <a href="{{ route('admin.promotions.index') }}">
                                    <span>{{ trans('admin.promotions') }}</span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.promotions.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.promotions.edit-main-seo') }}">{{ __('admin.promotion_seo_page') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.promotions.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.promotions.edit-one-page-seo') }}">{{ __('admin.one_promotion_seo') }}
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li @if(Route::is('admin.check-ups.*')) class="active" @endif>
                        <a href="{{ route('admin.check-ups.index') }}">
                            <i class="fa fa-check-circle-o"></i>
                            <span>{{ trans('admin.check_ups') }}</span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.check-ups.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-check-circle-o"></i> <span>{{ trans('admin.check_ups') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.check-ups.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.check-ups.index')) class="active" @endif>
                                <a href="{{ route('admin.check-ups.index') }}">
                                    <span>{{ trans('admin.check_ups') }}</span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.check-ups.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.check-ups.edit-main-seo') }}">{{ __('admin.check_up_page_seo') }}
                                </a>
                            </li> --}}
                            {{-- <li @if(Route::is('admin.check-ups.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.check-ups.edit-one-page-seo') }}">{{ __('admin.one_check_up_seo') }}
                                </a>
                            </li> --}}
                        {{-- </ul>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.article-categories.*') || Route::is('admin.articles.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="bx bx-home-heart"></i> <span>{{ trans('admin.articles') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.article-categories.*') || Route::is('admin.articles.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.article-categories.*')) class="active" @endif>
                                <a href="{{ route('admin.article-categories.index') }}">{{ trans('admin.categories') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.index') || Route::is('admin.articles.create') || Route::is('admin.articles.edit')) class="active" @endif >
                                <a href="{{ route('admin.articles.index') }}">{{ trans('admin.articles_list') }}

                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.articles.edit-main-seo') }}">{{ __('admin.blog_seo') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.articles.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.articles.edit-one-page-seo') }}">{{ __('admin.one_article_seo') }}
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.doctor-categories.*') || Route::is('admin.doctors.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-user-md"></i> <span>{{ __('admin.doctors') }}</span> <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.doctor-categories.*') || Route::is('admin.doctors.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.doctor-categories.*')) class="active" @endif>
                                <a href="{{ route('admin.doctor-categories.index') }}">{{ __('admin.categories') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.index') || Route::is('admin.doctors.create') || Route::is('admin.doctors.edit')) class="active" @endif >
                                <a href="{{ route('admin.doctors.index') }}">{{ __('admin.doctors_list') }}

                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.doctors.edit-main-seo') }}">{{ __('admin.seo_doctors_page') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.doctors.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.doctors.edit-one-page-seo') }}">{{ __('admin.one_doctor_seo_page') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li @if(Route::is('admin.specializations.*')) class="active" @endif>
                        <a href="{{ route('admin.specializations.index') }}">
                            <i class="fa fa-stethoscope"></i>
                            <span>
                                Спеціалізації лікарів
                                {{ __('admin.specializations_of_doctors') }}
                            </span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-hospital-o"></i>
                            <span>
                                {{ __('admin.laboratories') }}
                                Лабораторії
                            </span>
                                <i class="fa fa-angle-right"></i></a>
                        <ul class="treeview-menu" @if(Route::is('admin.laboratory-cities.*') || Route::is('admin.laboratories.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.laboratory-cities.*')) class="active" @endif>
                                <a href="{{ route('admin.laboratory-cities.index') }}">
                                    {{ __('admin.laboratories_cities') }}
                                    Міста лабораторій
                                </a>
                            </li>
                            <li @if(Route::is('admin.laboratories.index') || Route::is('admin.laboratories.create') || Route::is('admin.laboratories.edit')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.index') }}">
                                    {{ __('admin.laboratories_list') }}
                                    Список лабораторій
                                </a>
                            </li>

                            <li @if(Route::is('admin.laboratories.prices.*')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.prices.index') }}">{{ __('admin.prices') }}
                                </a>
                            </li>
                            <li @if(Route::is('admin.laboratories.prices.edit-seo')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.prices.edit-seo') }}">
                                    СЕО сторінки ціни лабораторії
                                    {{ __('admin.one_laboratory_page_seo') }}
                                </a>
                            </li>

                            <li @if(Route::is('admin.laboratories.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.edit-main-seo') }}">
                                    {{ __('admin.laboratories_page_seo') }}
                                    СЕО сторінки лабораторій
                                </a>
                            </li>
                            <li @if(Route::is('admin.laboratories.edit-one-page-seo')) class="active" @endif >
                                <a href="{{ route('admin.laboratories.edit-one-page-seo') }}">
                                    СЕО однієї лабораторії
                                    {{ __('admin.one_laboratory_page_seo') }}
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li @if(Route::is('admin.surgery.*')) class="active" @endif>
                        <a href="{{ route('admin.surgery.index') }}">
                            <i class="fa fa-medkit"></i>
                            <span>Хірургія</span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.surgery.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-medkit"></i>
                                <span>
                                    {{ __('admin.surgery') }}
                                    Хірургія
                                </span> <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('admin.surgery.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.surgery.index')) class="active" @endif>
                                <a href="{{ route('admin.surgery.index') }}">
                                    <span>
                                        {{ __('admin.surgery') }}
                                        Хірургія
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.surgery.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.surgery.edit-main-seo') }}">
                                    СЕО сторінки хірургія
                                    {{ __('admin.surgery_page_seo') }}
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- <li @if(Route::is('admin.vacancies.*')) class="active" @endif>
                        <a href="{{ route('admin.vacancies.index') }}">
                            <i class="fa fa-address-book-o"></i>
                            <span>Вакансії</span>
                        </a>
                    </li> --}}

                    {{-- <li class="treeview @if(Route::is('admin.vacancies.*')) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-address-book-o"></i>
                            <span>
                                {{ __('admin.vacancy') }}
                                Вакансії
                            </span> <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(Route::is('admin.vacancies.*')) style="display: block;" @else style="display: none;" @endif>
                            <li @if(Route::is('admin.vacancies.index') || Route::is('admin.vacancies.create' || Route::is('admin.vacancies.edit'))) class="active" @endif>
                                <a href="{{ route('admin.vacancies.index') }}">
                                    <span>
                                        {{ __('admin.vacancy') }}
                                        Список вакансій
                                    </span>
                                </a>
                            </li>
                            <li @if(Route::is('admin.vacancies.edit-main-seo')) class="active" @endif >
                                <a href="{{ route('admin.vacancies.edit-main-seo') }}">
                                    СЕО сторінки вакансій
                                    {{ __('admin.vacancy_page_seo') }}
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="treeview @if(
                        Route::is('admin.main-page.*')
                        || Route::is('admin.header.*')
                        || Route::is('admin.footer.*')
                    ) menu-open @endif">
                        <a href="javascript:void(0)"><i class="fa fa-cog"></i>
                            <span>
                                {{ __('admin.settings') }}
                            </span> <i class="fa fa-angle-right"></i>
                        </a>
                        <ul class="treeview-menu" @if(
                        Route::is('admin.main-page.*')
                        || Route::is('admin.footer.*')
                        || Route::is('admin.header.*')
                        || Route::is('admin.lead-settings.index')
                        // || Route::is('admin.lead-apps.index')
                        || Route::is('admin.edit-robots')
                        || Route::is('admin.language-settings.index')

                        ) style="display: block;" @else style="display: none;" @endif>
                            {{-- <li @if(Route::is('admin.main-page.show') || Route::is('admin.main-page.edit-block')) class="active" @endif>
                                <a href="{{ route('admin.main-page.show') }}">
                                    Головна сторінка
                                    {{ __('admin.main_page') }}
                                </a>
                            </li>

                            <li @if(Route::is('admin.main-page.edit-seo')) class="active" @endif>
                                <a href="{{ route('admin.main-page.edit-seo') }}">
                                    СЕО головної сторінки
                                    {{ __('admin.main_page_seo') }}
                                </a>
                            </li> --}}

                            <li @if(Route::is('admin.header.*')) class="active" @endif>
                                <a href="{{ route('admin.header.edit') }}">
                                    {{-- Хедер --}}
                                    {{ __('admin.header') }}
                                </a>
                            </li>

                            <li @if(Route::is('admin.footer.edit')) class="active" @endif>
                                <a href="{{ route('admin.footer.edit') }}">
                                    {{-- Футер --}}
                                    {{ __('admin.footer') }}
                                </a>
                            </li>

                            <li @if(Route::is('admin.footer.links.edit')) class="active" @endif>
                                <a href="{{ route('admin.footer.links.edit') }}">
                                    {{-- Сортування посилань в футері --}}
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.sort_footer_elements'), 0, 1) }}</span>{{ mb_substr(__('admin.sort_footer_elements'), 1) }}
                                    </span>
                                </a>
                            </li>

                            <li @if(Route::is('admin.edit-robots')) class="active" @endif>
                                <a href="{{ route('admin.edit-robots') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">R</span>obots.txt
                                    </span>
                                </a>
                            </li>

                            {{-- <li @if(Route::is('admin.lead-apps.index')) class="active" @endif>
                                <a href="{{ route('admin.lead-apps.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.lead_applications'), 0, 1) }}</span>{{ mb_substr(__('admin.lead_applications'), 1) }}
                                    </span>
                                </a>
                            </li> --}}

                            <li @if(Route::is('admin.lead-settings.index')) class="active" @endif>
                                <a href="{{ route('admin.lead-settings.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.lead_form_settings'), 0, 1) }}</span>{{ mb_substr(__('admin.lead_form_settings'), 1) }}
                                    </span>
                                </a>
                            </li>

                            <li @if(Route::is('admin.language-settings.index')) class="active" @endif>
                                <a href="{{ route('admin.language-settings.index') }}">
                                    <span style="text-transform: lowercase;">
                                        <span style="text-transform: uppercase;">{{ mb_substr(__('admin.language_settings'), 0, 1) }}</span>{{ mb_substr(__('admin.language_settings'), 1) }}
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- <li @if(Route::is('admin.vacancy-apps.index')) class="active" @endif>
                        <a href="{{ route('admin.vacancy-apps.index') }}">
                            <i class="fa fa-address-book-o"></i>
                            <span>Заявки вакансій</span>
                        </a>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</div>
