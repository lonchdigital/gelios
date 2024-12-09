<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ __('admin.laboratories_pages_blocks_list') }}</h5>

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
                <h6 class="mt-3">{{ __('admin.pages.' . $group) }}</h6>

                @if($group == 'main')
                    <a href="{{ route('admin.laboratories.create-slide', ['page' => $this->page2]) }}"
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
                                        {{ __('admin.pages.' . $block->key) }}
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
                                                href="{{ route('admin.laboratories.edit-slide', ['page' => $this->page2, 'block' => $block]) }}"
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
                    <h6 class="card-title mb-0">{{ __('admin.laboratories_list') }}</h6>

                    <a href="{{ route('admin.laboratories.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_laboratory') }}
                    </a>
                </div>

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('admin.address') }}</th>
                                <th>Email</th>
                                <th>{{ __('admin.phone_number') }}</th>
                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($this->laboratories as $laboratory)
                            <tr>
                                <td>{{ $laboratory->address }}</td>
                                <td>
                                    {{ $laboratory->email }}
                                </td>
                                <td>
                                    {{ $laboratory->phone }}
                                </td>
                                <td style="text-align: right">
                                    <a href="{{ route('admin.laboratories.edit', ['laboratory' => $laboratory]) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                    <a wire:click="deleteItem('{{ $laboratory->id }}', 'laboratory')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->laboratories->links() }}
        </div>
    </div>
</div>
