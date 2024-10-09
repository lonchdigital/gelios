@if( isset($data) && !isEmptyHtml($data->text_one) )
    <div class="media-content--inner row flex-column-reverse {{ ($data->is_reverse) ? 'flex-lg-row-reverse' : '' }} flex-lg-row {{ (isset($mb) && is_null($mb)) ? '' : 'mb-24' }}">
        <div class="col-12 col-lg-6">
            <div class="content-wrap">
                {{-- <div class="h3 font-weight-bolder text-blue mb-5">Якими захворюваннями займається хірургія?</div> --}}
                <div class="h3 font-weight-bolder text-blue"></div>
                <div class="content os-scrollbar-overflow">
                    {!! $data->text_one !!}
                    {{-- <ul class="list-unstyled mb-0">
                        <li>підвищена температура, ГРВІ</li>
                        <li>будь-якого характеру і тривалості болю в різних частинах тіла</li>
                        <li>регулярне відчуття втоми</li>
                        <li>кашель, ознаки ускладненого дихання, характерні хрипи в легенях</li>
                        <li>підвищений або знижений артеріальний тиск</li>
                        <li>паморочиться або болить голова</li>
                        <li>погіршення пам’яті</li>
                        <li>висипи на шкірі</li>
                        <li>проблеми з травленням</li>
                        <li>депресія, нестабільний сон, підвищене почуття тривожності</li>
                        <li>кашель, ознаки ускладненого дихання, характерні хрипи в легенях</li>
                        <li>підвищений або знижений артеріальний тиск</li>
                        <li>паморочиться або болить голова</li>
                        <li>погіршення пам’яті</li>
                        <li>висипи на шкірі</li>
                        <li>проблеми з травленням</li>
                        <li>депресія, нестабільний сон, підвищене почуття тривожності</li>
                    </ul> --}}
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @if($data->is_image)
                @if(!is_null($data->image))
                    <div class="wrap-img">
                        <img src="{{ '/storage/' . $data->image }}" alt="img">
                    </div>
                @endif
            @else
                <div class="content-wrap">
                    <div class="h3 font-weight-bolder text-blue"></div>
                    <div class="content os-scrollbar-overflow">
                        {!! $data->text_two !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif