@extends('site.layout.app')

@section('head')
    @include('site.components.head', [
        'title' => $page->meta_title ?: $page->title,
        'description' => $page->meta_description,
        'url' => $url
    ])
@endsection

@section('content')
    @include('site.components.breadcrumbs', [
        'breadcrumbs' => [
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
                                        <input type="search" class="search-input" placeholder="{{ __('web.search_input') }}">
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
                                        @if (!empty($doctor->age))
                                            <div class="experience-quantity mb-3">{{ trans('doctor.work_experience') . ': ' . $doctor->getAgeWithWord() }}
                                                {{-- років --}}
                                            </div>
                                        @endif
                                        <div class="h4 mb-1 font-weight-bolder">{{ $doctor->title }}</div>
                                        <div class="position-work">{{ $doctor->specialty ?? '' }}</div>
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

                // initPagination();
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
                        // initPagination();
                    })
                    .catch(error => console.error('Error fetching doctors:', error));

                // initPagination();
            };

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const type = button.textContent.trim().toLowerCase();
                    const typeValue = type === 'дорослим' ? 'adult' : type === 'дітям' ?
                        'children' : null;
                    updateQueryAndFetch('type', typeValue);

                    initPagination();
                });
            });

            searchInput.addEventListener('input', (e) => {
                const searchValue = e.target.value.trim();
                updateQueryAndFetch('search', searchValue);
                initPagination();
            });

            categorySelect.addEventListener('change', (e) => {
                const categoryId = e.target.value;
                updateQueryAndFetch('category', categoryId);
                initPagination();
            });

            // import $ from 'jquery';

            // Функція для плавної прокрутки до елемента
            function scrollToElement(element) {
                if ($(element).length > 0) {
                    var headerHeight = $('header').outerHeight();
                    var targetScroll = $(element).offset().top - headerHeight - 20;
                    $('html, body').animate({ scrollTop: targetScroll }, 'slow');
                }
            }

            // Функція для генерації масиву сторінок
            function getPageList(totalPages, page, maxLength) {
                if (maxLength < 5) throw "maxLength must be at least 5";

                function range(start, end) {
                    return Array.from(Array(end - start + 1), (_, i) => i + start);
                }

                var sideWidth = maxLength < 9 ? 1 : 2;
                var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
                var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;

                if (totalPages <= maxLength) {
                    return range(1, totalPages);
                }
                if (page <= maxLength - sideWidth - 1 - rightWidth) {
                    return range(1, maxLength - sideWidth - 1)
                        .concat([0])
                        .concat(range(totalPages - sideWidth + 1, totalPages));
                }
                if (page >= totalPages - sideWidth - 1 - rightWidth) {
                    return range(1, sideWidth)
                        .concat([0])
                        .concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
                }

                return range(1, sideWidth)
                    .concat([0])
                    .concat(range(page - leftWidth, page + rightWidth))
                    .concat([0])
                    .concat(range(totalPages - sideWidth + 1, totalPages));
            }

            // Функція для ініціалізації або перевстановлення пагінації
            function initPagination() {
                // console.log(123456);

                setTimeout(function () {
                    $(".pagination").empty();

                    var targetElement = '#doctors';
                    var numberOfItems = $("#doctors .doctors--item").length;
                    // var limitPerPage = 12;
                    var w = screen.width;
                    if (w < 768) {
                        var limitPerPage = 5;
                    } else if (w < 1024) {
                        var limitPerPage = 8;
                    } else {
                        var limitPerPage = 16;
                    }
                    var totalPages = Math.ceil(numberOfItems / limitPerPage);
                    console.log(numberOfItems);
                    var paginationSize = 7;
                    var currentPage;

                    function showPage(whichPage) {
                        if (whichPage < 1 || whichPage > totalPages) return false;
                        currentPage = whichPage;
                        $(targetElement + " .content-item").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();
                        $(targetElement + " .pagination li").slice(1, -1).remove();
                        getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                            $("<li>").addClass("page-item " + (item ? "current-page " : "") + (item === currentPage ? "active " : ""))
                                .append($("<a>").addClass("page-link").attr({ href: "javascript:void(0)" }).text(item || "..."))
                                .insertBefore(targetElement + " #next-page");
                        });

                        // Add or remove active class from previous and next buttons
                        if (currentPage === 1) {
                            $("#previous-page").addClass("active");
                        } else {
                            $("#previous-page").removeClass("active");
                        }

                        if (currentPage === totalPages) {
                            $("#next-page").addClass("active");
                        } else {
                            $("#next-page").removeClass("active");
                        }

                        return true;
                    }

                    // Include the prev/next buttons:
                    $("#doctors .pagination").append(
                        $("<li>").addClass("page-item button-slider-prev").attr({ id: "previous-page" }).append(
                            $(`<a><svg><use xlink:href=",` + iconsPath + `"#i-arrow-small-down>`)
                                .addClass("page-link")
                                .attr({
                                    href: "javascript:void(0)"
                                })
                            // .text("Prev")
                        ),
                        $("<li>").addClass("page-item button-slider-next").attr({ id: "next-page" }).append(
                            $(`<a><svg><use xlink:href=",` + iconsPath + `"#i-arrow-small-down>`)
                                .addClass("page-link")
                                .attr({
                                    href: "javascript:void(0)"
                                })
                            // .text("Next")
                        )
                    );
                    // Show the page links
                    if (totalPages > 1) {
                        $("#doctors").show();
                        showPage(1);
                        $("#doctors .pagination").show();
                    } else {
                        $("#doctors .pagination").hide();
                    }

                    $(document).on("click", targetElement + " .pagination li.current-page:not(.active)", function () {
                        var targetPage = +$(this).text();
                        showPage(targetPage);
                        scrollToElement(targetElement);
                    });

                    $(targetElement + " #next-page").on("click", function () {
                        if (currentPage < totalPages) {
                            var nextPage = currentPage + 1;
                            showPage(nextPage);
                            scrollToElement(targetElement);
                        }
                    });

                    $(targetElement + " #previous-page").on("click", function () {
                        if (currentPage > 1) {
                            var prevPage = currentPage - 1;
                            showPage(prevPage);
                            scrollToElement(targetElement);
                        }
                    });
                }, 1000);
            }
        });
    </script>
@endsection
