@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.laboratory.create-edit', ['laboratory' => $laboratory])
    </div>
@endsection