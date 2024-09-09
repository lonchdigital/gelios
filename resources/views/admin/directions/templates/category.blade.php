@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.directions.templates.category', ['direction' => $direction])
    </div>
@endsection
