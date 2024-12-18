@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.article.edit-block', ['block' => $block])
    </div>
@endsection
