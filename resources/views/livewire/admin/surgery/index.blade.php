<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">Список блоків сторінки Хірургія</h5>

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

                @if($group == 'static_block')
                    <a href="{{ route('admin.surgery.create-static-block', ['page' => $this->page2]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати статичний блок
                    </a>
                @endif
                </div>
                    <table class="table mt-1">
                        <thead>
                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                <th>Ключ</th>
                                <th>Зображення</th>
                                <th>Заголовок</th>
                                <th>Опис</th>
                                <th>
                                    Посилання
                                </th>
                                <th style="text-align: right">Дії</th>
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
                                        {{ $block->link }}
                                    </td>
                                    <td>
                                        <div style="text-align: right">
                                            <a role="button"
                                                href="{{ route('admin.surgery.edit-block', ['block' => $block]) }}"
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

                @if(empty($this->page2->pageBlocks->where('block', 'static_block')->count()))
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">Список статичних блоків</h6>

                        <a href="{{ route('admin.surgery.create-static-block', ['page' => $this->page2]) }}"
                            class="btn btn-primary waves-effect waves-light float-right mb-3">
                            + Додати статичний блок
                        </a>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">Список напрямків сторінки Хірургія</h6>

                    <a href="{{ route('admin.surgery.create') }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати напрямок
                    </a>
                </div>

                <table class="table mt-1">
                    <thead>
                        <tr style="background-color: rgba(149, 149, 149, 0.2)">
                            <th>Назва напрямку</th>
                            <th style="text-align: right">Дії</th>
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
