@if( isset($data) && !isEmptyHtml($data->text_one) )
    <div class="media-content--inner row flex-column-reverse {{ ($data->is_reverse) ? 'flex-lg-row-reverse' : '' }} flex-lg-row">
        <div class="col-12 col-lg-6">
            <div class="content-wrap">
                <div class="h4 font-weight-bolder text-blue mb-5"></div>
                <div class="content os-scrollbar-overflow">
                    {!! $data->text_one !!}
                </div>
            </div>
        </div>
        @if($data->is_image)
            <div class="col-12 col-lg-6 d-none d-lg-flex">
                @if(!is_null($data->image))
                    <a href="{{ '/storage/' . $data->image }}"
                        data-fancybox="media--gallery-{{ $iteration }}" class="w-100">
                        <div class="wrap-img">
                            <img src="{{ '/storage/' . $data->image }}" alt="img">
                        </div>
                    </a>
                @endif
            </div>
        @else
            <div class="col-12 col-lg-6">
                <div class="content-wrap">
                    <div class="h4 font-weight-bolder text-blue mb-5"></div>
                    <div class="content os-scrollbar-overflow">
                        {!! $data->text_two !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif