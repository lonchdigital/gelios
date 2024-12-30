@if( isset($data) && (!isEmptyHtml($data->text_one) || !isEmptyHtml($data->text_two)) )
    @if($data->is_image)
        <div class="col-12 col-xl-4 mb-5 mb-xl-0">
            <div class="position-relative rounded-sm overflow-hidden h-100">
                @if(!is_null($data->image))
                    <div class="wrap-img">
                        <img class="bg-down" src="{{ '/storage/' . $data->image }}" alt="img">
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="col-12 col-md-6 col-xl-4 mb-5 mb-md-0">
            <div class="bg-white rounded-sm p-3 p-md-6 d-flex flex-column min-h-500 h-0">
                <div class="h3 font-weight-bolder text-blue mb-8 mb-md-5"></div>
                <div class="content os-scrollbar-overflow">
                    {!! $data->text_one !!}
                </div>
            </div>
        </div>
    @endif

    <div class="col-12 col-md-6 col-xl-4">
        <div class="bg-white rounded-sm p-3 p-md-6 d-flex flex-column min-h-500 h-0">
            <div class="h3 font-weight-bolder text-blue mb-8 mb-md-5"></div>
            <div class="content os-scrollbar-overflow">
                {!! $data->text_two !!}
            </div>
        </div>
    </div>
@endif