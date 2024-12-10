@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.surgery.conditions.create-edit', ['page' => $page, 'block' => $block])
    </div>
@endsection
