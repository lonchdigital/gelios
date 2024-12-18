@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
            [
                'title' => 'Головна',
                'url' => route('main'),
            ],
            [
                'title' => $page->title ?? __('doctor.doctors'),
                'url' => null,
            ],
        ],
    ])
    <section id="doctors" class="doctors mb-24">
        <div class="container">
            <div class="row mb-8">
                <div class="col d-flex align-items-center justify-content-between">
                    <div class="h2 font-m font-weight-bolder text-blue">{{ $page->title ?? 'Лікарі' }}</div>
                </div>
            </div>
            <div class="doctors--nav">
                <div class="row">
                    <div class="col">
                        <div class="category row mb-5">
                            <div class="col col-sm-auto">
                                <button type="button" class="btn btn-outline-blue active">{{ __('doctor.all') }}</button>
                            </div>
                            @forelse($types as $type)
                                <div class="col col-sm-auto">
                                    <button type="button" class="btn btn-outline-blue">{{ __('doctor.' . $type) }}</button>
                                </div>
                            @empty
                            @endforelse
                            {{-- <div class="col col-sm-auto">
                                <button type="button" class="btn btn-outline-blue">Дітям</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row mb-8">
                            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                                <div class="field field-select-default">
                                    <div class="select-wrap">
                                        <select class="select-doctors-category" id="doctor-category-select">
                                            <option value="">{{ __('doctor.all_doctors') }}</option>
                                            @forelse($categories as $category)
                                                <option value="{{ $category->title }}">{{ $category->title }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-9">
                                <div class="search">
                                    <div class="input-search">
                                        <input type="search" class="search-input" placeholder="Пошук">
                                        <button type="button" class="search-icon btn p-0"></button>
                                    </div>
                                    <div class="results-search"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="doctors-list row">
                        @forelse($doctors as $doctor)
                            <div class="content-item col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="doctors--item">
                                    <a href="{{ route('doctors.show', ['doctor' => $doctor->slug ?? $doctor->id]) }}"
                                        class="inner">
                                        <div class="wrap-img mb-3">
                                            <img src="{{ $doctor->imageUrl }}" alt="{{ $doctor->title }}">
                                        </div>
                                        @if (!empty($doctor->expirience))
                                            <div class="experience-quantity mb-3">Досвід роботи: {{ $doctor->expirience }}
                                                років
                                            </div>
                                        @endif
                                        <div class="h4 mb-1 font-weight-bolder">{{ $doctor->title }}</div>
                                        <div class="position-work">{{ $doctor->specialization->title ?? '' }}</div>
                                    </a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav class="mt-5 mt-lg-3">
                        <ul class="pagination justify-content-center mb-0"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.category .btn');
            const searchInput = document.querySelector('.search-input');
            const categorySelect = document.querySelector('.select-doctors-category');

            const getQueryParams = () => {
                const urlParams = new URLSearchParams(window.location.search);
                return Object.fromEntries(urlParams.entries());
            };

            const updateQueryAndFetch = (key, value) => {
                const urlParams = new URLSearchParams(getQueryParams());

                if (value) {
                    urlParams.set(key, value);
                } else {
                    urlParams.delete(key);
                }

                urlParams.delete('page');

                const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
                window.history.replaceState({}, '', newUrl);

                fetchDoctors(newUrl);
            };

            const fetchDoctors = (url) => {
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch data');
                        }
                        return response.text();
                    })
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newDoctorsList = doc.querySelector('.doctors-list');
                        const newPagination = doc.querySelector('nav');

                        document.querySelector('.doctors-list').innerHTML = newDoctorsList.innerHTML;
                        document.querySelector('nav').innerHTML = newPagination ? newPagination.innerHTML :
                            '';
                    })
                    .catch(error => console.error('Error fetching doctors:', error));
            };

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const type = button.textContent.trim().toLowerCase();
                    const typeValue = type === 'дорослим' ? 'adult' : type === 'дітям' ?
                        'children' : null;
                    updateQueryAndFetch('type', typeValue);
                });
            });

            searchInput.addEventListener('input', (e) => {
                const searchValue = e.target.value.trim();
                updateQueryAndFetch('search', searchValue);
            });

            categorySelect.addEventListener('change', (e) => {
                const categoryId = e.target.value;
                updateQueryAndFetch('category', categoryId);
            });
        });
    </script>
@endsection
