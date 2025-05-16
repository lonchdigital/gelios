<section class="nav-breadcrumb mt-8 mb-8">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item main">
                            <a href="{{ route('main') }}">
                                Helyos
                            </a>
                        </li>
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if ( !$loop->last )
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['full_path'] }}">{{ $breadcrumb['name'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>