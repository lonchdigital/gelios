<div class="offices--item swiper-slide" style="height: 100%">
    <div class="inner">
        <div class="inner-top">
            <div class="wrap-img mb-4">
                @if($contact->image)
                    <img src="{{ '/storage/' . $contact->image }}" alt="img">
                @endif
                <div class="city-label">{{ $contact->city }}</div>
            </div>
            <div class="city-pin mb-3">{{ $contact->city }}, <br>{{ $contact->street }}</div>
            @foreach ($contact->items->where('type', 'email') as $email)
                <div class="email mb-2"><a href="mailto:{{ $email->item }}">{{ $email->item }}</a></div>
            @endforeach
            @foreach ($contact->items->where('type', 'phone') as $phone)
                <div class="phone mb-3"><a href="tel:{{ $phone->item }}">{{ $phone->item }}</a></div>
            @endforeach
        </div>
        
        <div class="inner-bottom">
            <a href="{{ route('offices.page') . '#office-' . $contact->id }}"class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">
                {{ trans('web.more_details') }}
            </a>
        </div>
    </div>
</div>