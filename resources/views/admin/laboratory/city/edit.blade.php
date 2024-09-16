@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.laboratory.city.create-edit', ['city' => $city])
    </div>
@endsection
