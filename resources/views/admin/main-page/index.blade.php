@extends('admin.layouts.index')

@push('head')
    <link rel="stylesheet" href="{{ asset('admin_src/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_src/css/default-assets/daterange-picker.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('admin_src/css/default-assets/modal.css') }}"> --}}
@endpush

@section('content')
    <div class="container-fluid">
        @livewire('admin.main-page.index')

        @livewire('admin.modals.delete')

        @livewire('admin.main-page.seo', ['page' => $page])
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin_src/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin_src/js/default-assets/daterange-picker.js') }}"></script>

    <script src="{{ asset('admin_src/js/default-assets/modal-classes.js') }}"></script>
    <script src="{{ asset('admin_src/js/default-assets/modaleffects.js') }}"></script>
@endpush
