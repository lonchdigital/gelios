@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.specialization.create-edit', ['specialization' => $category])
    </div>
@endsection
