import $ from 'jquery';

const appLocale = document.head.querySelector('meta[name="app-locale"]').content;
const $searchInput = $('#search-input');
const $itemsWrapper = $('#accordion-prices-list');

runAjaxfilter();

$searchInput.on('input', function(){
    runAjaxfilter();
});


function runAjaxfilter()
{

    ajaxSearchFilterItems(
        getQueryData(),
        function (data) {

            if( data['items'].length > 0 ) {
                handleItemsResult(data['items']);
            } else {
                // nothingFound();
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
        let price = Math.floor(priceItem.price);

        allPrices += `
            <div class="item">
                <div class="name">${priceItemService}</div>
                <div class="price">${price} грн</div>
            </div>
        `;
    });

    return `
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${iteration}">
                <div class="h4 mb-0">
                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${iteration}" aria-expanded="false" aria-controls="collapse-accordion-prices-list-${iteration}">${title}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${iteration}" class="collapse" aria-labelledby="heading-accordion-prices-list-${iteration}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${allPrices}
                </div>
            </div>
        </div>
    `;
}