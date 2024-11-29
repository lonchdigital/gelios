@extends('admin.layouts.index')

@section('content')
    <div class="container-fluid">
        @livewire('admin.article.create-edit', ['article' => $article])
        @livewire('admin.modals.delete')
    </div>
@endsection
