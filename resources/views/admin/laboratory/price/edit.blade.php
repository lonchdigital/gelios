@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.laboratory.price.create-edit', ['category' => $category])
        @livewire('admin.modals.delete')
    </div>
@endsection
