@foreach ($children as $child)
    <tr>
        <td><a href="{{ route('directions.edit', ['directionId' => $child['id']]) }}">{{ str_repeat('- ', $level) . $child['name'] }}</a></td>
        <td class="text-right">

        </td>
    </tr>
    @if (!empty($child['children']))
        @include('admin.directions.partials.direction-children', ['children' => $child['children'], 'level' => $level + 1])
    @endif
@endforeach