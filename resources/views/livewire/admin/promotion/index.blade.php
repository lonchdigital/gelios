<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ __('admin.promotion_page_blocks_list') }}</h5>

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

                @if($group == 'main')
                    <a href="{{ route('admin.promotions.create-slide', ['page' => $this->page2]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_slide') }}
                    </a>
                @endif

                @if($group == 'second' && !$this->page2->pageBlocks->where('block', 'main')->count())
                    <a href="{{ route('admin.promotions.create-slide', ['page' => $this->page2]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_slide') }}
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
                                    <td style="text-align: right">
                                        <a role="button"
                                            @if($block->key == 'slider')
                                                href="{{ route('admin.promotions.edit-slide', ['page' => $this->page2, 'block' => $block]) }}"
                                            @else
                                                href="{{ route('admin.promotions.edit-block', ['page' => $this->page2, 'block' => $block]) }}"
                                            @endif
                                            class="mr-2">
                                            <i class="fa fa-edit text-info font-18"></i>
                                        </a>
                                        @if($block->key == 'slider')
                                            <a wire:click="deleteItem('{{ $block->id }}', 'pageBlock')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                @empty
                @endforelse

                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">{{ __('admin.promotions_list') }}</h6>

                    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_promotion') }}
                    </a>
                </div>

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('admin.name') }}</th>
                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($this->promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->title }}</td>
                                <td style="text-align: right">
                                    <a href="{{ route('admin.promotions.edit', $promotion->slug ?? $promotion->id) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                    <a wire:click="deleteItem('{{ $promotion->id }}', 'promotion')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
        </div>
    </div>
</div>
