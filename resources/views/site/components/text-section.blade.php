@if( isset($data) && !isEmptyHtml($data->text_one) )
    <div class="media-content--inner row flex-column-reverse {{ ($data->is_reverse) ? 'flex-lg-row-reverse' : '' }} flex-lg-row {{ (isset($mb) && !is_null($mb)) ? 'mb-'.$mb : 'mb-24' }}">
        <div class="col-12 col-lg-6">
            <div class="content-wrap">
                <div class="h3 font-weight-bolder text-blue"></div>
                <div class="content rich-text-block os-scrollbar-overflow">
                    {!! $data->text_one !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @if($data->is_image)
                @if(!is_null($data->image))
                    <div class="wrap-img">
                        <img src="{{ '/storage/' . $data->image }}" alt="{{ (isset($alt)) ? $alt : 'img' }}">
                    </div>
                @endif
            @else
                <div class="content-wrap">
                    <div class="h3 font-weight-bolder text-blue"></div>
                    <div class="content rich-text-block os-scrollbar-overflow">
                        {!! $data->text_two !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif