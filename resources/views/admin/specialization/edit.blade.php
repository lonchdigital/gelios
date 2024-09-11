@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.specialization.create-edit', ['specalization' => $specalization])
    </div>
@endsection
