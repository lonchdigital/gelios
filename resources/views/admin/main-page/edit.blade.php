@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.main-page.edit', ['block' => $block])
    </div>
@endsection
