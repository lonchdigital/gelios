@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.promotion.create-edit')

        @livewire('admin.main-page.seo', ['page' => $page])
    </div>
@endsection
