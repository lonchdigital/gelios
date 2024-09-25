<section class="nav-breadcrumb mt-8 mb-8">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb mb-0">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if (!empty($breadcrumb['url']) && !$loop->last)
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                            @endif
                        @endforeach
                        {{-- <li class="breadcrumb-item">
                            <a href="index.html">
                                <svg class="i-home">
                                    <use xlink:href="img/icons/icons.svg#i-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="##">Акції</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Консультація анестезіолога у Дніпрі</li> --}}
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
