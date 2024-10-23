<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">Список блоків сторінки Вакансії</h5>

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

                    </div>
                    <table class="table mt-1">
                        <thead>
                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                <th>Ключ</th>
                                <th>Зображення</th>
                                <th>Заголовок</th>
                                <th>Опис</th>
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
                    <h6 class="card-title mb-0">Список вакансій</h6>

                    <a href="{{ route('admin.vacancies.create') }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати вакансію
                    </a>
                </div>

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>Назва</th>
                                <th style="text-align: right">Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->vacancies as $vacancy)
                                <tr>
                                    <td>{{ $vacancy->title }}</td>
                                    <td style="text-align: right">
                                        <a href="{{ route('admin.vacancies.edit', ['vacancy' => $vacancy]) }}"
                                            class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
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
