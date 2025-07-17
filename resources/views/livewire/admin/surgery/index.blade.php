<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class=" mb-0">{{ __('admin.surgery_page_blocks_list') }}</h5>

                    {{-- <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати лікаря
                    </a> --}}
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @forelse($this->page2->pageBlocks->groupBy('block') as $group => $blocks)

                <div class="d-flex justify-content-between align-items-center mb-20">
                <h6 class="mt-3">{{ __('admin.' . $group) }}</h6>

                @if($group == 'static_block')
                    <a href="{{ route('admin.surgery.create-static-block', ['page' => $this->page2]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_static_block') }}
                    </a>
                @endif

                @if($group == 'conditions')
                    <a href="{{ route('admin.surgery.create-conditions-block', ['page' => $this->page2]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_image') }}
                    </a>
                @endif

                @if($group == 'Inpatient')
                    <a href="{{ route('admin.surgery.create-inpatient-block', ['page' => $this->page2]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_image') }}
                    </a>
                @endif
                </div>
                    <table class="table mt-1">
                        <thead>
                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                <th>{{ __('admin.key') }}</th>
                                <th>{{ __('admin.image') }}</th>
                                <th>{{ __('admin.title') }}</th>
                                <th>{{ __('admin.description') }}</th>
                                <th>
                                    {{ __('admin.link') }}
                                </th>
                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blocks as $block)
                                <tr class="hover">
                                    <td>
                                        {{ __('admin.' . $block->key) }}
                                    </td>
                                    <td>
                                        @if ($block->image)
                                            <img src="{{ $block->imageUrl }}" width="40">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $block->title }}
                                    </td>
                                    <td>
                                        {{ $block->description }}
                                    </td>
                                    <td>
                                        {{ $block->url }}
                                    </td>
                                    <td class="flex" style="text-align: right;">
                                        {{-- <div style="text-align: right"> --}}
                                            @if($group == 'conditions' && $block->key == 'image')
                                                <a role="button"
                                                    href="{{ route('admin.surgery.edit-conditions-block', ['page' => $this->page2, 'block' => $block]) }}"
                                                    class="btn btn-accent btn-xs">
                                                    <i class="fa fa-edit text-info font-16"></i>
                                                </a>
                                            @elseif ($group == 'Inpatient' && $block->key == 'image')
                                                <a role="button"
                                                    href="{{ route('admin.surgery.edit-inpatient-block', ['page' => $this->page2, 'block' => $block]) }}"
                                                    class="btn btn-accent btn-xs">
                                                    <i class="fa fa-edit text-info font-16"></i>
                                                </a>
                                            @else
                                                <a role="button"
                                                    href="{{ route('admin.surgery.edit-block', ['block' => $block]) }}"
                                                    class="btn btn-accent btn-xs">
                                                    <i class="fa fa-edit text-info font-16"></i>
                                                </a>
                                            @endif
                                            @if($group == 'static_block' || ($block->key == 'image' && $group !== 'second'))
                                                <a wire:click="deleteItem('{{ $block->id }}', 'pageBlock2')" style="cursor: pointer"><i class="fa fa-trash text-danger font-16"></i></a>
                                            @endif
                                        {{-- </div> --}}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                @empty
                @endforelse

                @if(empty($this->page2->pageBlocks->where('block', 'static_block')->count()))
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h6 class=" mb-0">{{ __('admin.static_blocks_list') }}</h6>

                        <a href="{{ route('admin.surgery.create-static-block', ['page' => $this->page2]) }}"
                            class="btn btn-primary waves-effect waves-light float-right mb-3">
                            + {{ __('admin.add_static_block') }}
                        </a>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class=" mb-0">{{ __('admin.surgery_page_directions_list') }}</h6>

                    <a href="{{ route('admin.surgery.create') }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_direction') }}
                    </a>
                </div>

                <table class="table mt-1">
                    <thead>
                        <tr style="background-color: rgba(149, 149, 149, 0.2)">
                            <th>{{ __('admin.direction_name') }}</th>
                            <th style="text-align: right">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->surgeries as $surgery)
                            <tr class="hover">
                                <td>
                                    {{ $surgery->title }}
                                </td>
                                <td>
                                    <div style="text-align: right">
                                        <a role="button"
                                            href="{{ route('admin.surgery.show', ['surgery' => $surgery]) }}"
                                            class="btn btn-accent btn-xs">
                                            <i class="fa fa-eye text-info font-18"></i>
                                        </a>
                                        <a role="button"
                                            href="{{ route('admin.surgery.edit', ['surgery' => $surgery]) }}"
                                            class="btn btn-accent btn-xs">
                                            <i class="fa fa-edit text-info font-18"></i>
                                        </a>
                                        <a wire:click="deleteItem('{{ $surgery->id }}', 'surgery')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        {{-- <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->doctors->links() }}
        </div> --}}
    </div>
</div>
