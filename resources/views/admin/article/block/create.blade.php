@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.article.block.create-edit', ['article' => $article])
    </div>
@endsection
