@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.main-page.slider.create-edit', ['page' => $page])
    </div>
@endsection