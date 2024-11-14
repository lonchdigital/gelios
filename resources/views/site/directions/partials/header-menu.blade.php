
<div class="push-menu--aside">
    @foreach ($data->where('template', 3) as $childDirection)
        <div class="item"><a href="{{ route('web.page.show', ['slug' => $childDirection['slug']]) }}">{{ $childDirection['name'] }}</a></div>
    @endforeach
</div>

<div class="push-menu--category">
    @foreach ($data->where('template', 2) as $childCatDir)
        <div class="push-menu--sub-category">

            @if( $childCatDir['children'] )
                <div class="item has-dropdown main-title">
                    <a href="##" class="heading" data-slug="{{ route('web.page.show', ['slug' => $childCatDir['slug']]) }}">{{ $childCatDir['name'] }}</a>
                    <div class="push-menu--lvl">
                        @include('site.directions.partials.header-menu', ['data' => collect($childCatDir['children'])])
                    </div>
                </div>
            @else
                <div class="item main-title">
                    <a href="{{ route('web.page.show', ['slug' => $childCatDir['slug']]) }}" class="heading">{{ $childCatDir['name'] }}</a>
                </div>
            @endif

            @foreach (collect($childCatDir['children']) as $childSubCatDir)

                @if( $childSubCatDir['children'] )
                    <div class="item has-dropdown">
                        <a href="##" data-slug="{{ route('web.page.show', ['slug' => $childSubCatDir['slug']]) }}">{{ $childSubCatDir['name'] }}</a>
                        <div class="push-menu--lvl">
                            @include('site.directions.partials.header-menu', ['data' => collect($childSubCatDir['children'])])
                        </div>
                    </div>
                @else
                    <div class="item">
                        <a href="{{ route('web.page.show', ['slug' => $childSubCatDir['slug']]) }}">
                            {{ $childSubCatDir['name'] }}
                        </a>
                    </div>
                @endif
                
            @endforeach

        </div>
    @endforeach
</div>