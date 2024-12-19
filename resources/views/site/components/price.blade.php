<div class="item">
    <div class="name">{{ $price->service }}</div>
    @if($price->is_free)
        <div class="price">{{ trans('web.free') }}</div>
    @else
        <div class="price">{{ intval($price->price) }} грн</div>
    @endif
</div>