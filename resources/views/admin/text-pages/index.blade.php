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
                            <h6 class="card-title mb-0">{{ trans('admin.text_pages_list') }}</h6>
                        </div>        
        
                        <div class="table-responsive art-cars-list">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Назва</th>
                                        <th style="text-align: right">Дії</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td>{{ $page->title }}</td>
                                        <td style="text-align: right">
                                            <a href="{{ route('text.pages.edit', $page) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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
