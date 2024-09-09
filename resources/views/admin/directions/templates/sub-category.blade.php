@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.directions.templates.sub-category', ['direction' => $direction])
    </div>
@endsection
