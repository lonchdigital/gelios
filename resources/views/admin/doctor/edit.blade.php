@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.doctor.create-edit', ['doctor' => $doctor])
    </div>
@endsection
