@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.surgery.conditions.create-edit', ['page' => $page])
    </div>
@endsection