@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.article.create-edit-slider', ['page' => $page, 'block' => $block])
    </div>
@endsection
