@if ($articles->hasPages())
    <ul class="pagination justify-content-center mb-0">
        {{-- Previous Page Link --}}
        @if ($articles->onFirstPage())
            <li class="page-item button-slider-prev disabled active no-hover" aria-disabled="true"
                aria-label="@lang('pagination.previous')" id="previous-page">
                <span class="page-link no-hover">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6L8 10L12 6" stroke="#111010" stroke-width="1.5" stroke-linejoin="round"
                            stroke-linecap="round" />
                    </svg>
                </span>
            </li>
        @else
            <li class="page-item button-slider-prev" id="previous-page">
                <a class="page-link" href="{{ route('articles.page', $articles->currentPage() - 1) }}" rel="prev"
                    aria-label="@lang('pagination.previous')">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6L8 10L12 6" stroke="#111010" stroke-width="1.5" stroke-linejoin="round"
                            stroke-linecap="round" />
                    </svg>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @for ($i = 1; $i <= $articles->lastPage(); $i++)
            @if ($i == $articles->currentPage())
                <li class="active current-page page-item" aria-current="page"><span
                        class="page-link">{{ $i }}</span></li>
            @else
                <li class="current-page page-item"><a href="{{ route('articles.page', $i) }}"
                        class="page-link">{{ $i }}</a></li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($articles->hasMorePages())
            <li class="page-item button-slider-next" id="next-page">
                <a class="page-link" href="{{ route('articles.page', $articles->currentPage() + 1) }}" rel="next"
                    aria-label="@lang('pagination.next')">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6L8 10L12 6" stroke="#111010" stroke-width="1.5" stroke-linejoin="round"
                            stroke-linecap="round" />
                    </svg>
                </a>
            </li>
        @else
            <li class="page-item disabled active no-hover" id="next-page" aria-disabled="true"
                aria-label="@lang('pagination.next')">
                <span class="page-link no-hover">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6L8 10L12 6" stroke="#111010" stroke-width="1.5" stroke-linejoin="round"
                            stroke-linecap="round" />
                    </svg>
                </span>
            </li>
        @endif
    </ul>
@endif
