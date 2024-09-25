@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.surgery.block.create-edit', ['page' => $page, 'block' => $block])
    </div>
@endsection
