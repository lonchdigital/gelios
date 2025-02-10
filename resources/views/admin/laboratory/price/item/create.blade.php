@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.laboratory.price.item.create-edit', ['category' => $category])
    </div>
@endsection
