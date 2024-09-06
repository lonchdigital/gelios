@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.promotion.create-edit', ['promotion' => $promotion])
    </div>
@endsection
