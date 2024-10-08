@if( !isEmptyHtml($data->text_one) )
    <div class="row flex-column-reverse {{ ($data->is_reverse) ? 'flex-lg-row-reverse' : '' }} flex-lg-row">
        <div class="col-12 col-lg-6">
            <div class="media-content">
                <div class="media-content--inner row flex-column-reverse flex-lg-row">
                    <div class="col-12">
                        <div class="content-wrap d-flex flex-column justify-content-between">
                            <div>
                                <div class="h2 font-m font-weight-bolder text-blue mb-5"></div>
                                <div class="content os-scrollbar-overflow">
                                    {!! $data->text_one !!}
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col">
                                    <div class="buttons d-flex flex-wrap">
                                        <button type="button" class="btn btn-blue" data-toggle="modal" data-target="#popup--sign-up-appointment">Записатися на прийом</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($data->is_image)
            <div class="col-12 col-lg-6 mb-8 mb-lg-0">
                <div class="position-relative align-content-end h-100 rounded-sm overflow-hidden text-white p-3 p-lg-6">
                    <div class="backdrop position-static">
                        @if(!is_null($data->image))
                            <div class="wrap-img">
                                <img class="bg-down" src="{{ '/storage/' . $data->image }}" alt="img">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 col-lg-6">
                <div class="media-content">
                    <div class="media-content--inner row flex-column-reverse flex-lg-row">
                        <div class="col-12">
                            <div class="content-wrap d-flex flex-column justify-content-between">
                                <div>
                                    <div class="h2 font-m font-weight-bolder text-blue mb-5"></div>
                                    <div class="content os-scrollbar-overflow">
                                        {!! $data->text_two !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif