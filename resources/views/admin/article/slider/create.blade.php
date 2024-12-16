@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.article.slider.create-edit', ['article' => $article])
    </div>
@endsection
