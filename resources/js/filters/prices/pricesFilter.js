import $ from 'jquery';

const appLocale = document.head.querySelector('meta[name="app-locale"]').content;
const $searchInput = $('#search-input');
const $itemsWrapper = $('#accordion-prices-list');

const $laboratoriesSearchInput = $('#laboratories-search-input');
const $laboratoriesItemsWrapper = $('#accordion-prices-list');

if (document.querySelector('#search-input')) {
    runAjaxfilter();
}

if (document.querySelector('#laboratories-search-input')) {
    runLaboratoriesAjaxfilter();
}

$searchInput.on('input', function(){
    runAjaxfilter();
});

$laboratoriesSearchInput.on('input', function(){
    runLaboratoriesAjaxfilter();
});

function runAjaxfilter()
{

    ajaxSearchFilterItems(
        getQueryData(),
        function (data) {

            if( data['items'].length > 0 ) {
                handleItemsResult(data['items']);
            } else {
                nothingFound();
            }
        },
        function () {
            console.error('[Prices]: error during filter.');
        }
    );
}

function ajaxSearchFilterItems(queryData = null, success, fail)
{
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    const appUrl = document.head.querySelector('meta[name="app-url"]').content;

    $.ajax({
        url: `${appUrl}/prices-search-filter`,
        type: 'post',
        data: {
            _token: csrfToken,
            query: queryData
        },
        dataType: 'json'
    }).done(function(data) {
        success(data);
    }).fail(function () {
        fail();
    });
}

function getQueryData()
{
    let queryData = {};

    queryData['search'] = $searchInput.val();

    return queryData;
}

function nothingFound()
{
    $itemsWrapper.html(`<div>${translations['nothing_found']}</div>`);
}

function handleItemsResult(data)
{
    let itemsToAppend = '';
    let iteration = 1;
    data.forEach(function (item) {
        itemsToAppend += buildItemHTML(item, iteration);
        iteration++;
    });

    $itemsWrapper.html(itemsToAppend);
}

function buildItemHTML(item, iteration)
{
    let itemTranslation = item.translations.find(translation => translation.locale === appLocale);
    let title = itemTranslation ? itemTranslation.title : '';
    let allPrices = '';

    item.additional_info.forEach(function (priceItem) {
        let priceItemTranslation = priceItem.translations.find(translation => translation.locale === appLocale);
        let priceItemService = priceItemTranslation ? priceItemTranslation.service : '';
        let price = priceItemTranslation ? priceItemTranslation.price : '';
        // let price = Math.floor(priceItem.price);
        let priceHtml = '';

        if(priceItem.is_free) {
            priceHtml = `<div class="price">${translations['free']}</div>`;
        } else {
            if(itemTranslation && itemTranslation.locale == 'en') {
                priceHtml = `<div class="price">${price} UAH</div>`;
            } else {
                priceHtml = `<div class="price">${price} грн</div>`;
            }
        }

        allPrices += `
            <div class="item">
                <div class="name">${priceItemService}</div>
                ${priceHtml}
            </div>
        `;
    });

    let isActive = iteration === 1 ? true : false;

    return `
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${iteration}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${isActive ? '' : 'collapsed'}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${iteration}" aria-expanded="${isActive ? 'true' : 'false'}" aria-controls="collapse-accordion-prices-list-${iteration}">${title}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${iteration}" class="collapse ${isActive ? 'show' : ''}" aria-labelledby="heading-accordion-prices-list-${iteration}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${allPrices}
                </div>
            </div>
        </div>
    `;
}

function runLaboratoriesAjaxfilter()
{
    ajaxLaboratoriesSearchFilterItems(
        getLaboratoriesQueryData(),
        function (data) {

            if( data['items'].length > 0 ) {
                handleLaboratoryItemsResult(data['items']);
            } else {
                nothingFound();
            }
        },
        function () {
            console.error('[Prices]: error during filter.');
        }
    );
}

function ajaxLaboratoriesSearchFilterItems(queryData = null, success, fail)
{
// console.log(queryData);
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    const appUrl = document.head.querySelector('meta[name="app-url"]').content;

    $.ajax({
        url: `${appUrl}/laboratories-prices-search-filter`,
        type: 'post',
        data: {
            _token: csrfToken,
            query: queryData
        },
        dataType: 'json'
    }).done(function(data) {
        success(data);
    }).fail(function () {
        fail();
    });
}

function getLaboratoriesQueryData()
{
    let queryData = {};

    queryData['search'] = $laboratoriesSearchInput.val();

    return queryData;
}

function buildLaboratoryItemHTML(item, iteration)
{
    let itemTranslation = item.translations.find(translation => translation.locale === appLocale);
    let title = itemTranslation ? itemTranslation.title : '';
    let allPrices = '';

    item.additional_info.forEach(function (priceItem) {
        let priceItemTranslation = priceItem.translations.find(translation => translation.locale === appLocale);
        let priceItemService = priceItemTranslation ? priceItemTranslation.service : '';
        let priceHtml = '';
// console.log(priceItemTranslation);
        if(priceItem.is_free) {
            priceHtml = `<div class="price">${translationsPrices.free}</div>`;
        } else {
            priceHtml = `<div class="price">${priceItemTranslation?.price ?? ''} ${priceItemTranslation?.price ? translationsPrices.uah : ''}</div>`;
        }

        allPrices += `
            <div class="item">
                <div class="name">${priceItemTranslation?.title ?? ''}</div>
                ${priceHtml}
            </div>
        `;
    });

    let isActive = iteration === 1 ? true : false;

    return `
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${iteration}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${isActive ? '' : 'collapsed'}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${iteration}" aria-expanded="${isActive ? 'true' : 'false'}" aria-controls="collapse-accordion-prices-list-${iteration}">${title}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${iteration}" class="collapse ${isActive ? 'show' : ''}" aria-labelledby="heading-accordion-prices-list-${iteration}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${allPrices}
                </div>
            </div>
        </div>
    `;
}

function handleLaboratoryItemsResult(data)
{
    let itemsToAppend = '';
    let iteration = 1;
    data.forEach(function (item) {
        itemsToAppend += buildLaboratoryItemHTML(item, iteration);
        iteration++;
    });

    $laboratoriesItemsWrapper.html(itemsToAppend);
}
