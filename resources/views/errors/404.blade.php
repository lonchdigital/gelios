@extends('site.layout.app')

@section('content')

    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 404,
            ],
        ],
    ])

    <section class="not-found text-blue mb-24">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="inner">
                        <div class="title mb-5">404</div>
                        <p class="mb-5">{{ trans('web.page_not_found') }}</p>
                        <a href="{{ route('main') }}" class="btn btn-blue">{{ trans('web.to_main') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
