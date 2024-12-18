@foreach ($children as $child)
    <tr class="child-direction">

        <td class="text-right">

        </td>
        <td>
            <a href="{{ $child['full_path'] }}" target="_blank"><i class="fa fa-eye text-info font-18"></i></a>
        </td>
        <td>
            <a href="{{ route('directions.edit', ['directionId' => $child['id']]) }}">
                {{ str_repeat('- ', $level) . $child['name'] }}
            </a>
        </td>

        <td class="text-right">
            <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $child['id'] }}">
                <i class="fa fa-trash text-danger font-18"></i>
            </a>
            <div class="md-modal md-effect-1" id="modal-{{ $child['id'] }}">
                <div class="md-content">
                    <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                    <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $child['name'] }}", {{ trans('admin.delete_all_directions') }}?</p>
                    <div class="d-flex art-modal-buttons">
                        <button class="btn btn-primary md-close">{{ trans('admin.close') }}</button>
                        <button wire:click="removeDirectionFromDB('{{ $child['id'] }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
                    </div>
                </div>
            </div>
        </td>

    </tr>
    @if (!empty($child['children']))
        @include('admin.directions.partials.direction-children', [
            'children' => $child['children'], 
            'level' => $level + 1
            ])
    @endif
@endforeach