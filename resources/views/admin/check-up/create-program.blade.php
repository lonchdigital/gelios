@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.check-up.program.create-edit', ['checkUp' => $checkUp])
    </div>
@endsection
