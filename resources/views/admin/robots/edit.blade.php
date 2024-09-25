@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @livewire('admin.robots.edit')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin_src/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin_src/js/default-assets/daterange-picker.js') }}"></script>

    <script src="{{ asset('admin_src/js/default-assets/modal-classes.js') }}"></script>
    <script src="{{ asset('admin_src/js/default-assets/modaleffects.js') }}"></script>
@endpush
