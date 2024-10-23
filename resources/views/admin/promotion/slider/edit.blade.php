@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.promotion.slider.create-edit', ['page' => $page, 'block' => $block])
    </div>
@endsection
