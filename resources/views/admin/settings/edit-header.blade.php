@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.settings.edit-header')
        @livewire('admin.modals.delete')
    </div>
@endsection
