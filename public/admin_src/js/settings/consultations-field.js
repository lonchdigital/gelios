// import $ from "jquery";

$(function() {
    'use strict';

    const $consultationSearchInput = $('#consultation-search-input');
    const $consultationSearchResult = $('#consultation-search-result');
    const $consultationTags = $('#art-consultation-tags');


    const $consultationSearchInputField = $('#consultation-search-input-field');
    $consultationSearchInputField.on('input', function() {
        runAjaxFilter();
    });

    // add tags
    $consultationSearchResult.on('click', '.doc-item', function(event) {
        var art_this = $(this);
        var currentId = art_this.data('id');
        var currentValues = $consultationSearchInput.val();
        var newValues = currentValues ? currentValues + ',' + currentId : currentId;

        // update values
        $consultationSearchInput.val(newValues);

        // add tag
        $consultationTags.append(`<button class="btn" data-id="${art_this.data('id')}">${art_this.text()}<i class="fa fa-close"></i></button>`);
        art_this.remove();
    });

    // remove tags
    $consultationTags.on('click', '.btn', function(event) {
        var art_this = $(this);
        var currentValues = $consultationSearchInput.val();

        var valuesArray = currentValues.split(",").map(function(item) {
            return parseInt(item, 10);
        });

        var indexToRemove = valuesArray.indexOf(art_this.data('id'));
        if (indexToRemove !== -1) {
            valuesArray.splice(indexToRemove, 1);
        }

        // update values
        var newValues = valuesArray.join(",");
        $consultationSearchInput.val(newValues);

        art_this.remove();
    });



    function runAjaxFilter(pageNumber = null) {

        ajaxThematicFilter(
            function (data) {
                if( data['documents'].length > 0 ) {
                    handResult(data['documents'])
                    $consultationSearchResult.removeClass('d-none');
                } else {
                    $consultationSearchResult.html(getNothingFoundHTML());
                    $consultationSearchResult.removeClass('d-none');
                }
            },
            function () {
                console.error('init: error during Search.');
            },
            $consultationSearchInputField.val(),
            $consultationSearchInput.val()
        );
    }

    function ajaxThematicFilter(success, fail, searchValue, excludePostIds)
    {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const appUrl = document.head.querySelector('meta[name="app-url"]').content;

        $.ajax({
            url: `${appUrl}/consultations-search`,
            type: 'post',
            data: {
                _token: csrfToken,
                search: searchValue,
                excludePostIds: excludePostIds
            },
            dataType: 'json'
        }).done(function(data) {
            success(data);
        }).fail(function () {
            fail();
        });
    }


    function handResult(data)
    {
        let documentsToAppend = '';
        if(data.length > 0) {
            data.forEach(function (document, index) {
                documentsToAppend += getDocumentHTML(document);
            });
        } else {
            for (let key in data) {
                documentsToAppend += getDocumentHTML(data[key]);
            }
        }

        $consultationSearchResult.html(documentsToAppend);
    }

    function getDocumentHTML(document)
    {
        return `<div class="doc-item" data-id="${document['id']}">${document['name']}</div>`;
    }
    function getNothingFoundHTML()
    {
        return `<div class="doc-item-nothing">Нічого не знайдено</div>`;
    }


    // Hide and Show Search result
    const $artConsultationFields = $('.art-consultation-fields');
    $(document).on('click', function(event) {
        if (!$artConsultationFields.is(event.target) && $artConsultationFields.has(event.target).length === 0) {
            $consultationSearchResult.addClass('d-none');
        }
    });
    $artConsultationFields.on('click', function(event) {
        event.stopPropagation();
    });

});
