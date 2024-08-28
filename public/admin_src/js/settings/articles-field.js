// import $ from "jquery";

$(function() {
    'use strict';

    const $articleSearchInput = $('#article-search-input');
    const $articleSearchResult = $('#article-search-result');
    const $articleTags = $('#art-article-tags');


    const $articleSearchInputField = $('#article-search-input-field');
    $articleSearchInputField.on('input', function() {
        runAjaxFilter();
    });

    // add tags
    $articleSearchResult.on('click', '.doc-item', function(event) {
        var art_this = $(this);
        var currentId = art_this.data('id');
        var currentValues = $articleSearchInput.val();
        var newValues = currentValues ? currentValues + ',' + currentId : currentId;

        // update values
        $articleSearchInput.val(newValues);

        // add tag
        $articleTags.append(`<button class="btn" data-id="${art_this.data('id')}">${art_this.text()}<i class="fa fa-close"></i></button>`);
        art_this.remove();
    });

    // remove tags
    $articleTags.on('click', '.btn', function(event) {
        var art_this = $(this);
        var currentValues = $articleSearchInput.val();

        var valuesArray = currentValues.split(",").map(function(item) {
            return parseInt(item, 10);
        });

        var indexToRemove = valuesArray.indexOf(art_this.data('id'));
        if (indexToRemove !== -1) {
            valuesArray.splice(indexToRemove, 1);
        }

        // update values
        var newValues = valuesArray.join(",");
        $articleSearchInput.val(newValues);

        art_this.remove();
    });



    function runAjaxFilter(pageNumber = null) {

        ajaxThematicFilter(
            function (data) {
                if( data['documents'].length > 0 ) {
                    handResult(data['documents'])
                    $articleSearchResult.removeClass('d-none');
                } else {
                    $articleSearchResult.html(getNothingFoundHTML());
                    $articleSearchResult.removeClass('d-none');
                }
            },
            function () {
                console.error('init: error during Search.');
            },
            $articleSearchInputField.val(),
            $articleSearchInput.val()
        );
    }

    function ajaxThematicFilter(success, fail, searchValue, excludeArticleIds)
    {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const appUrl = document.head.querySelector('meta[name="app-url"]').content;

        $.ajax({
            url: `${appUrl}/articles-search`,
            type: 'post',
            data: {
                _token: csrfToken,
                search: searchValue,
                excludeArticleIds: excludeArticleIds
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

        $articleSearchResult.html(documentsToAppend);
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
    const $artArticleFields = $('.art-article-fields');
    $(document).on('click', function(event) {
        if (!$artArticleFields.is(event.target) && $artArticleFields.has(event.target).length === 0) {
            $articleSearchResult.addClass('d-none');
        }
    });
    $artArticleFields.on('click', function(event) {
        event.stopPropagation();
    });

});
