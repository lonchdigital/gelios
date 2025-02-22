<option value="{{ $direction['id'] }}">{{ str_repeat('-', $depth) . ' ' . $direction['name'] }}</option>

@if (!empty($direction['children']))
    @foreach($direction['children'] as $child)
        <x-admin.directions.direction-option :direction="$child" :depth="$depth + 1" />
    @endforeach
@endif