@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.surgery.block.create-edit', ['block' => $block])
    </div>
@endsection
