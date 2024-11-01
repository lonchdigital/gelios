@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.check-up.create-edit', ['checkUp' => $checkUp])
        @livewire('admin.modals.delete')
    </div>
@endsection
