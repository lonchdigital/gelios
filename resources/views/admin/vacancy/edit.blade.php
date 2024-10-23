@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.vacancy.create-edit', ['vacancy' => $vacancy])
    </div>
@endsection
