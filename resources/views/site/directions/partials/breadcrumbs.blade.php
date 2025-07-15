{{-- <section class="nav-breadcrumb mt-8 mb-8">
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
</section> --}}
<section class="nav-breadcrumb mt-8 mb-8">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb mb-0" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item main"
                            itemprop="itemListElement"
                            itemscope itemtype="http://schema.org/ListItem">
                            <a href="{{ route('main') }}"
                               itemprop="item">
                                <span itemprop="name">Helyos</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>

                        @foreach($breadcrumbs as $index => $breadcrumb)
                            @php
                                $position = $index + 2;
                                $isLast = $loop->last;
                            @endphp

                            <li class="breadcrumb-item {{ $isLast ? 'active' : '' }}"
                                @if(!$isLast)
                                    itemprop="itemListElement"
                                    itemscope itemtype="http://schema.org/ListItem"
                                @endif
                                {{ $isLast ? 'aria-current="page"' : '' }}>

                                @if(!$isLast)
                                    <a href="{{ $breadcrumb['full_path'] }}"
                                       itemprop="item">
                                        <span itemprop="name">{{ $breadcrumb['name'] }}</span>
                                    </a>
                                    <meta itemprop="position" content="{{ $position }}" />
                                @else
                                    <span itemprop="name">{{ $breadcrumb['name'] }}</span>
                                    <meta itemprop="position" content="{{ $position }}" />
                                @endif
                            </li>
                        @endforeach

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
