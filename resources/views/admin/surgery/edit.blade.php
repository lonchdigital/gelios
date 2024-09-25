@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.surgery.edit', ['block' => $block])
    </div>
@endsection
