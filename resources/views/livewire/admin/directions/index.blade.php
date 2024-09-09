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
                                                <select class="form-control" id="status-select" wire:model="directionTemplate" name="template_id">
                                                    @foreach(App\DataClasses\DirectionTemplateTypeClass::get() as $template)
                                                        <option value="{{ $template['id'] }}">{{ $template['name'] }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        {{-- @dd($allDirections) --}}
                                        <div class="mb-3">
                                            <label>{{ trans('admin.categories') }}</label>
                                                <select class="form-control" id="status-select" wire:model="directionParent" name="parent_id">
                                                    <option value="{{ null }}">- {{ trans('admin.not_chosen') }} -</option>
                                                    @foreach($allDirections as $cat)
                                                        @include('admin.directions.partials.direction-option', ['direction' => $cat, 'depth' => 0])
                                                    @endforeach
                                                </select>
                                        </div>
                                    <button type="submit" class="btn btn-primary mr-2 mb-3">{{ trans('admin.save') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Some text</h4>
                                {{-- @dd($allDirections) --}}

                                <div class="template-demo">
                                    <table class="dark-lincs table mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('admin.direction') }}</th>
                                                <th class="text-right">Sort</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allDirections as $direction)
                                                <tr>
                                                    <td><a href="{{ route('directions.edit', ['directionId' => $direction['id']]) }}">{{ $direction['name'] }}</a></td>
                                                    <td class="text-right">
                                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                                    </td>
                                                </tr>
                                                @if (!empty($direction['children']))
                                                    @include('admin.directions.partials.direction-children', ['children' => $direction['children'], 'level' => 1])
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
