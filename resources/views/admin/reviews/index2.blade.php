@extends('admin.layouts.index')

@push('head')
    <link rel="stylesheet" href="{{ asset('admin_src/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_src/css/default-assets/daterange-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_src/css/default-assets/modal.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-30">
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-20">
                            <h6 class="card-title mb-0">{{ __('admin.reviews') }}</h6>

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
                                            {{ trans('admin.reviews_page') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('reviews.page.edit') }}"  class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ trans('admin.reviews') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('reviews.index') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            {{ trans('admin.unpublished_reviews') }}
                                        </td>
                                        <td style="text-align: right">
                                            <a href="{{ route('unpublished.reviews.index') }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
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
