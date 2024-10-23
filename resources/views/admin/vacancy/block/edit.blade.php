@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.vacancy.block.create-edit', ['page' => $page, 'block' => $block])
    </div>
@endsection
