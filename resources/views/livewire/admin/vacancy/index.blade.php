<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class=" mb-0">{{ __('admin.vacancy_page_blocks_list') }}</h5>

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

                    </div>
                    <table class="table mt-1">
                        <thead>
                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                <th>{{ __('admin.key') }}</th>
                                <th>{{ __('admin.image') }}</th>
                                <th>{{ __('admin.title') }}</th>
                                <th>{{ __('admin.description') }}</th>
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
                                        <div style="text-align: right">
                                            <a role="button"
                                                href="{{ route('admin.vacancies.edit-block', ['page' => $this->page2, 'block' => $block]) }}"
                                                class="btn btn-accent btn-xs">
                                                <i class="fa fa-edit text-info font-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                @empty
                @endforelse

                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">{{ __('admin.vacancy_list') }}</h6>

                    <a href="{{ route('admin.vacancies.create') }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_vacancy') }}
                    </a>
                </div>

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.is_active') }}</th>
                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->vacancies as $vacancy)
                                <tr>
                                    <td>{{ $vacancy->title }}</td>
                                    <td>
                                        <div class="new-checkbox art-text-block-switcher">
                                            <label class="switch mr-3">
                                                <input type="checkbox" wire:click="changeActive('{{ $vacancy->id }}')"
                                                    @if ($vacancy->is_active) checked @endif>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td style="text-align: right">
                                        <a href="{{ route('admin.vacancies.edit', ['vacancy' => $vacancy]) }}"
                                            class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                        <a wire:click="deleteItem('{{ $vacancy->id }}', 'vacancy')"
                                            style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->vacancies->links() }}
        </div>
    </div>
</div>
