<div class="row">
    <div class="col-12">
        <div class=" mb-30">
            <div class=" pb-0">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-head mb-20">
                    <h4 class="card-head-title">{{ trans('admin.directions') }}</h4>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent="save">
                                    <x-admin.multilanguage-input
                                        :is-required="true"
                                        :label="trans('admin.title')"
                                        field-name="name"
                                        field-display="name"
                                        live-wire-field="directionName"
                                        :values="[]"
                                        />
                                        @error('directionName.ua')
                                            <div class="mt-1 text-danger ajaxError">
                                                {{ $message }}
                                            </div>
                                        @enderror                               
                                        <div class="mb-3">
                                            <label>{{ trans('admin.template') }}</label>
                                                <select class="form-control" wire:model="directionTemplate">
                                                    @foreach(App\DataClasses\DirectionTemplateTypeClass::get() as $template)
                                                        <option value="{{ $template['id'] }}">{{ $template['name'] }}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label>{{ trans('admin.belonging') }}</label>
                                                <select class="form-control" wire:model="directionParent" name="parent_id">
                                                    <option value="{{ null }}">- {{ trans('admin.not_chosen') }} -</option>
                                                    @foreach($allDirections as $cat)
                                                        @include('admin.directions.partials.direction-option', ['direction' => $cat, 'depth' => 0])
                                                    @endforeach
                                                </select>
                                        </div> --}}

                                        <section class="mb-3">

                                            <div wire:ignore>
                                                <label>{{ trans('admin.belonging') }}</label>
                                                <select class="js-parent-cat form-control" id="status-select" wire:model="directionParent" name="parent_id">
                                                    <option value="{{ null }}">- {{ trans('admin.not_chosen') }} -</option>
                                                    @foreach($allDirections as $cat)
                                                        @include('admin.directions.partials.direction-option', ['direction' => $cat, 'depth' => 0])
                                                    @endforeach
                                                </select>
                                            </div>
    
                                            <div wire:ignore class="mt-3">
                                                <label>{{ trans('admin.offices') }}</label>
                                                <select id="offices" class="js-direction-contacts-multiple form-control" name="offices[]" wire:model="directionContacts" multiple>
                                                    @foreach ($allDirectionContacts as $directionContactItem)
                                                        <option value="{{ $directionContactItem->id }}">{{ $directionContactItem->city . ' ' . $directionContactItem->street }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
    
                                        </section>

                                    <button type="submit" class="btn btn-primary mr-2 mb-3">{{ trans('admin.save') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ (is_null($direction)) ? trans('admin.all_directions') : $direction->name }}</h4>
                                {{-- @dd($allDirections) --}}

                                <form id="directionForm" action="#" method="GET" class="mb-5">
                                    <div class="row aligh-items-center">
                                        <div class="col-md-9">
                                            <select class="form-control" id="directionSelect">
                                                <option value="{{ null }}">- {{ trans('admin.all_directions') }} -</option>
                                                @foreach($allDirections as $cat)
                                                    @include('admin.directions.partials.direction-option', ['direction' => $cat, 'depth' => 0])
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary" onclick="goToCategory()">{{ trans('admin.choose') }}</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="template-demo">
                                    <table class="dark-lincs table mb-0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>{{ trans('admin.direction') }}</th>
                                                <th class="text-right">{{ trans('admin.remove') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody wire:sortable="updateOrder" id="art-directions-container" class="art-directions-container">
                                            @foreach ($allDirections as $direction)
                                                <tr wire:sortable.item="{{ $direction['id'] }}" 
                                                    wire:key="direction-{{ $direction['id'] }}" 
                                                    class="art-drag-item drag-item"
                                                    id="parent-direction-{{ $direction['id'] }}">
                                                    <td>
                                                        <i class="fa fa-bars art-bars-move" 
                                                        aria-hidden="true" 
                                                        wire:sortable.handle 
                                                        style="cursor:move"></i>
                                                    </td>
                                                    <td>
                                                        <a href="#" target="_blank"><i class="fa fa-eye text-info font-18"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('directions.edit', ['directionId' => $direction['id']]) }}">{{ $direction['name'] }}</a>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $direction['id'] }}">
                                                            <i class="fa fa-trash text-danger font-18"></i>
                                                        </a>
                                                        <div class="md-modal md-effect-1" id="modal-{{ $direction['id'] }}">
                                                            <div class="md-content">
                                                                <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                                <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $direction['name'] }}", {{ trans('admin.delete_all_directions') }}?</p>
                                                                <div class="d-flex art-modal-buttons">
                                                                    <button class="btn btn-primary md-close">{{ trans('admin.close') }}</button>
                                                                    <button wire:click="removeDirectionFromDB('{{ $direction['id'] }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if (!empty($direction['children']))
                                                    @include('admin.directions.partials.direction-children', [
                                                        'children' => $direction['children'], 
                                                        'level' => 1
                                                    ])
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{-- {{ $this->faqs->links('vendor.pagination.default') }} --}}
        </div>
    </div>
</div>

@push('scripts')

    <script>
        function goToCategory() {
            var directionId = document.getElementById('directionSelect').value;
            
            if (directionId) {
                window.location.href = '/admin/directions/category/' + directionId;
            } else {
                window.location.href = '/admin/directions/';
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableRowBars = document.querySelectorAll('.art-bars-move');

            tableRowBars.forEach(row => {
                row.addEventListener('mousedown', function () {
                    const directionsTable = document.getElementById('art-directions-container');
                    const rowsToHide = directionsTable.querySelectorAll(`tr.child-direction`);

                    rowsToHide.forEach(row => {
                        row.style.display = 'none';
                    });
                });
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener('livewire:load', () => {
            
            // Handle directionParent
            let parentCat = $('.js-parent-cat').select2();
            parentCat.val(@json($directionParent)).trigger('change');
            parentCat.on('change', function () {
                let selectedValue = $(this).val();
                @this.set('directionParent', selectedValue);
            });

            // Handle directionContacts
            let directionContacts = $('.js-direction-contacts-multiple').select2();
            directionContacts.val(@json($directionContacts)).trigger('change');
            directionContacts.on('change', function () {
                let selectedValues = $(this).val();
                @this.set('directionContacts', selectedValues);
            });

        });
    </script>
    
@endpush
