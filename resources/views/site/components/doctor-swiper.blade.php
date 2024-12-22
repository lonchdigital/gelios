<div class="reviews--item swiper-slide">
    <div class="inner">
        @if(!is_null($review->image))
            <div class="wrap-img">
                <img src="{{ '/storage/' . $review->image }}" alt="img">
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="user-name h4 font-weight-bolder">{{ $review->name }}</div>
            <div class="reviews-date h6 font-weight-bold text-grey">{{ $review->created_at->format('d.m.Y') }}</div>
        </div>
        <div class="reviews--content os-scrollbar-overflow">{!! $review->text !!}</div>
    </div>
</div>