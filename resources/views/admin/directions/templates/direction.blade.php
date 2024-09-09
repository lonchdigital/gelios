@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.directions.templates.direction', ['direction' => $direction])
    </div>
@endsection
