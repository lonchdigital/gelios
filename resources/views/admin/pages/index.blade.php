@extends('admin.layouts.index')

@push('head')
    <link rel="stylesheet" href="{{ asset('admin_src/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_src/css/default-assets/daterange-picker.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('admin_src/css/default-assets/modal.css') }}"> --}}
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-30">
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-20">
                            <h6 class="card-title mb-0">{{ __('admin.pages2') }}</h6>

                            {{-- <div class="d-flex justify-content-between align-items-center mb-20">
                                <div>
                                <input type="text" wire:model.live="search" class="form-control mb-3" placeholder="пошук">
                                </div>
                                &nbsp;
                                <div>
                                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                                        + {{ __('admin.add_doctor') }}
                                    </a>
                                </div>
                            </div> --}}
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


                        <div class="table-responsive art-cars-list">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('admin.title') }}</th>
                                        <th style="text-align: right">{{ __('admin.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ __('admin.main_page') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('admin.main-page.show') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                        <td>
                                            {{ __('admin.main_page_seo') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('admin.main-page.edit-seo') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr> --}}

                                    <tr>
                                        <td>
                                            {{ trans('admin.about_us') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('about.us.edit') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ trans('admin.hospitals_stationary') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('hospitals.index') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ trans('admin.contacts') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('contacts.index') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ trans('admin.offices') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('offices.index') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>{{ $page->title }}</td>
                                            <td style="text-align: right">
                                                <a href="{{ route('text.pages.edit', $page) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td>{{ trans('admin.insurance_companies_page') }}</td>
                                        <td style="text-align: right">
                                            <a href="{{ route('insurance.companies.page.edit') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ trans('admin.insurance_companies') }}</td>
                                        <td style="text-align: right">
                                            <a href="{{ route('insurance.companies.index') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin_src/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin_src/js/default-assets/daterange-picker.js') }}"></script>

    <script src="{{ asset('admin_src/js/default-assets/modal-classes.js') }}"></script>
    <script src="{{ asset('admin_src/js/default-assets/modaleffects.js') }}"></script>
@endpush
