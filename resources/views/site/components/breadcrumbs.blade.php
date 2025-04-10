<section class="nav-breadcrumb mt-8 mb-8">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item main">
                            <a href="{{ route('main') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="#3DA6D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 22V12H15V22" stroke="#3DA6D3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </li>
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
