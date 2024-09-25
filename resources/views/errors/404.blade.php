@extends('site.layout.app')

@section('content')
<section class="nav-breadcrumb mt-8 mb-8">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <svg class="i-home">
                                    <use xlink:href="img/icons/icons.svg#i-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">404</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="not-found text-blue mb-24">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="inner">
                    <div class="title mb-5">404</div>
                    <p class="mb-5">Сторінку не знайдено</p>
                    <a href="index.html" class="btn btn-blue">На головну</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
