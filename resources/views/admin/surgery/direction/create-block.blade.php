@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.surgery.direction.block.create-edit', ['surgery' => $surgery])
    </div>
@endsection
