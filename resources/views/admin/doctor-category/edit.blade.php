@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.doctor-category.create-edit', ['category' => $category])
    </div>
@endsection