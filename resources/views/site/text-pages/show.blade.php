@extends('site.layout.app')

@section('content')

    @include('site.components.breadcrumbs', [
    'breadcrumbs' => [
        [
            'title' => trans('web.main'),
            'url' => route('main'),
        ],
        [
            'title' => $page->title,
        ],
    ],
    ])

    <section class="typical-text mb-24">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h2 font-m font-weight-bolder text-blue mb-8">{{ $page->title ?? '' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="content">
                        {!! $page->text !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
