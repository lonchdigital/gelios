@if ($paginator->hasPages())
    <ul class="pagination justify-content-center mb-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item button-slider-prev disabled active no-hover" aria-disabled="true" aria-label="@lang('pagination.previous')" id="previous-page">
                <span class="page-link no-hover">
                    {{-- <svg><use xlink:href="img/icons/icons.svg#i-arrow-small-down"></use></svg> --}}
                    <svg width="16.000000" height="16.000000" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <desc>
                                Created with Pixso.
                        </desc>
                        <defs>
                            <clipPath id="clip12_24291">
                                <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="white" fill-opacity="0"/>
                            </clipPath>
                        </defs>
                        <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="#FFFFFF" fill-opacity="0"/>
                        <g clip-path="url(#clip12_24291)">
                            <path id="Vector" d="M4 6L8 10L12 6" stroke="#111010" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round" stroke-linecap="round"/>
                        </g>
                    </svg>
                </span>
            </li>
        @else
            <li class="page-item button-slider-prev" id="previous-page">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <svg width="16.000000" height="16.000000" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <desc>
                                Created with Pixso.
                        </desc>
                        <defs>
                            <clipPath id="clip12_24291">
                                <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="white" fill-opacity="0"/>
                            </clipPath>
                        </defs>
                        <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="#FFFFFF" fill-opacity="0"/>
                        <g clip-path="url(#clip12_24291)">
                            <path id="Vector" d="M4 6L8 10L12 6" stroke="#111010" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round" stroke-linecap="round"/>
                        </g>
                    </svg>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled page-item" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active current-page page-item" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="current-page page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item button-slider-next" id="next-page">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <svg width="16.000000" height="16.000000" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <desc>
                                Created with Pixso.
                        </desc>
                        <defs>
                            <clipPath id="clip12_24291">
                                <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="white" fill-opacity="0"/>
                            </clipPath>
                        </defs>
                        <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="#FFFFFF" fill-opacity="0"/>
                        <g clip-path="url(#clip12_24291)">
                            <path id="Vector" d="M4 6L8 10L12 6" stroke="#111010" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round" stroke-linecap="round"/>
                        </g>
                    </svg>
                </a>
            </li>
        @else
            <li class="page-item disabled active no-hover" id="next-page" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link no-hover">
                    <svg width="16.000000" height="16.000000" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <desc>
                                Created with Pixso.
                        </desc>
                        <defs>
                            <clipPath id="clip12_24291">
                                <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="white" fill-opacity="0"/>
                            </clipPath>
                        </defs>
                        <rect id="arrow-small-down" width="16.000000" height="16.000000" fill="#FFFFFF" fill-opacity="0"/>
                        <g clip-path="url(#clip12_24291)">
                            <path id="Vector" d="M4 6L8 10L12 6" stroke="#111010" stroke-opacity="1.000000" stroke-width="1.500000" stroke-linejoin="round" stroke-linecap="round"/>
                        </g>
                    </svg>
                </span>
            </li>
        @endif
    </ul>
@endif