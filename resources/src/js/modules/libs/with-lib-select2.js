import $ from 'jquery';
import select2 from 'select2';
select2();
import { updateQueryAndFetch } from './common';
// import "../../../../../node_modules/select2/dist/js/select2.js";

//? select


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
		placeholder: 'Категорії статей',
		dropdownCssClass: 'news-category-results',
		dropdownParent: $('.news-head')
	});

    $('.select-doctors-category').on('select2:select', function (e) {
        const categoryId = $(this).val();
        // console.log(categoryId);
        updateQueryAndFetch('category', categoryId);
    });

});
