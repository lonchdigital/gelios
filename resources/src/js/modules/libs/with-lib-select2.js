import $ from 'jquery';
import select2 from 'select2';
select2();
import { updateQueryAndFetch, updateQueryAndFetchArticles } from './common';
// import "../../../../../node_modules/select2/dist/js/select2.js";

//? select

$(document).ready(() => {
    $('.select-doctors-category').select2({
        minimumResultsForSearch: -1,
        dropdownParent: $('.doctors')
    });

    $('.select-doctors-category').on('select2:select', function (e) {
        console.log(123);
        const categoryId = e.params.data.id;
        updateQueryAndFetch2('category', categoryId);
        initPagination();
    });
});

$(function() {
	$('.select-choose-specialist').select2({
		minimumResultsForSearch: -1,
		// dropdownParent: $('.main')
		// placeholder: 'Оберіть фахівця',
	});

	$('.select-choose-clinic').select2({
		minimumResultsForSearch: -1,
		// dropdownParent: $('.main')
		// placeholder: 'Оберіть клініку',
	});

    $('.select-choose-specialists').select2({
		minimumResultsForSearch: -1,
		dropdownParent: $('#popup--sign-up-appointment')
		// placeholder: 'Оберіть фахівця',
	});

	$('.select-choose-clinics').select2({
		minimumResultsForSearch: -1,
		dropdownParent: $('#popup--sign-up-appointment')
		// placeholder: 'Оберіть клініку',
	});

	$('.select-choose-specialist--popup').select2({
		minimumResultsForSearch: -1,
		dropdownCssClass: 'select-up-index',
		dropdownParent: $('main')
		// placeholder: 'Оберіть фахівця',
	});

	$('.select-choose-clinic--popup').select2({
		minimumResultsForSearch: -1,
		dropdownCssClass: 'select-up-index',
		dropdownParent: $('main')
	});

	$('.select-doctors-category').select2({
		minimumResultsForSearch: -1,
		dropdownParent: $('.doctors')
	});

	$('.select-news-category').select2({
		minimumResultsForSearch: -1,
		placeholder: articleTranslations.articleCategories,
		dropdownCssClass: 'news-category-results',
		dropdownParent: $('.news-head')
	});

    $('.select-doctors-category').on('select2:select', function (e) {
        const categoryId = $(this).val();
        // console.log(categoryId);
        updateQueryAndFetch('category', categoryId);
    });

    $('.select-news-category').on('select2:select', function (e) {
        const categoryId = $(this).val();
        // console.log(categoryId);
        updateQueryAndFetchArticles('category', categoryId);
    });

});

function initPagination() {

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

function updateQueryAndFetch2 (key, value) {
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

const getQueryParams = () => {
    const urlParams = new URLSearchParams(window.location.search);
    return Object.fromEntries(urlParams.entries());
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
