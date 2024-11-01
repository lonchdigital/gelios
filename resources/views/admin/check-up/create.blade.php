@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.check-up.create-edit')
        @livewire('admin.modals.delete')
    </div>
@endsection
