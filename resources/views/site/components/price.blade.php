<div class="item">
    <div class="name">{{ $price->service }}</div>
    @if($price->is_free)
        <div class="price">{{ trans('web.free') }}</div>
    @else
        @if( app()->getLocale() == 'en' )
            <div class="price">{{ $price->price }} UAH</div>
        @else
            <div class="price">{{ $price->price }} грн</div>
        @endif
    @endif
</div>