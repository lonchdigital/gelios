@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.promotion.edit-block', ['page' => $page, 'block' => $block])
    </div>
@endsection
