@if( isset($data) && !isEmptyHtml($data->text_one) )
    <div class="row flex-column-reverse {{ ($data->is_reverse) ? 'flex-lg-row-reverse' : '' }} flex-lg-row">
        <div class="col-12 col-lg-6">
            <div class="media-content">
                <div class="media-content--inner row flex-column-reverse flex-lg-row">
                    <div class="col-12">
                        <div class="content-wrap d-flex flex-column justify-content-between">
                            <div>
                                <div class="h2 font-m font-weight-bolder text-blue mb-5"></div>
                                <div class="content rich-text-block os-scrollbar-overflow">
                                    {!! $data->text_one !!}
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col col-lg-auto">
                                    <button type="button" class="btn btn-outline-blue font-weight-bold px-lg-10" data-toggle="modal" data-target="#popup--write-review">{{ trans('web.leave_review') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($data->is_image)
            @if(!is_null($data->image))
                <div class="col-12 col-lg-6 mb-8 mb-lg-0">
                    <div class="position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                        <div class="backdrop position-static">
                            <div class="wrap-img">
                                <img class="bg-down" src="{{ '/storage/' . $data->image }}" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="col-12 col-lg-6">
                <div class="content-wrap">
                    <div class="h4 font-weight-bolder text-blue mb-5"></div>
                    <div class="content rich-text-block os-scrollbar-overflow">
                        {!! $data->text_two !!}
                    </div>
                </div>
            </div>
        @endif

    </div>
@endif