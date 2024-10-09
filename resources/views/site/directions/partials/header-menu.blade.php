
<div class="push-menu--aside">
    @foreach ($data->where('template', 3) as $childDirection)
        <div class="item"><a href="{{ route('direction.itself', ['pageDirection' => $childDirection['slug']]) }}">{{ $childDirection['name'] }}</a></div>
    @endforeach
</div>

<div class="push-menu--category">
    @foreach ($data->where('template', 2) as $childCatDir)
        <div class="push-menu--sub-category">

            @if( $childCatDir['children'] )
                <div class="item has-dropdown main-title">
                    <a href="##" class="heading">{{ $childCatDir['name'] }}</a>
                    <div class="push-menu--lvl">
                        @include('site.directions.partials.header-menu', ['data' => collect($childCatDir['children'])])
                    </div>
                </div>
            @else
                <div class="item main-title">
                    <a href="{{ route('direction.sub-category', ['pageDirection' => $childCatDir['slug']]) }}" class="heading">{{ $childCatDir['name'] }}</a>
                </div>
            @endif

            @foreach (collect($childCatDir['children']) as $childSubCatDir)

                @if( $childSubCatDir['children'] )
                    <div class="item has-dropdown">
                        <a href="##">{{ $childSubCatDir['name'] }}</a>
                        <div class="push-menu--lvl">
                            @include('site.directions.partials.header-menu', ['data' => collect($childSubCatDir['children'])])
                        </div>
                    </div>
                @else
                    <div class="item">
                        @if ($childSubCatDir['template'] === 2)
                            <a href="{{ route('direction.sub-category', ['pageDirection' => $childSubCatDir['slug']]) }}">
                                {{ $childSubCatDir['name'] }}
                            </a>
                        @elseif ($childSubCatDir['template'] === 3)
                            <a href="{{ route('direction.itself', ['pageDirection' => $childSubCatDir['slug']]) }}">
                                {{ $childSubCatDir['name'] }}
                            </a>
                        @endif
                    </div>
                @endif
                
            @endforeach

        </div>
    @endforeach
</div>