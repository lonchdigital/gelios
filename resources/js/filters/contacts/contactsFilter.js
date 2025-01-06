import $ from 'jquery';

const appLocale = document.head.querySelector('meta[name="app-locale"]').content;
const $searchInput = $('#search-input');
const $itemsWrapper = $('#art-contacts-list');

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
        url: `${appUrl}/contacts-search-filter`,
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

    data.forEach(function (item) {
        itemsToAppend += buildItemHTML(item);
    });

    $itemsWrapper.html(itemsToAppend);
}

function buildItemHTML(item)
{
    let itemTranslation = item.translations.find(translation => translation.locale === appLocale);
    let city = itemTranslation ? itemTranslation.city : '';
    let street = itemTranslation ? itemTranslation.street : '';
    let allEmails = '';
    let allPhones = '';
    let mapButton = '';
    
    if( item.map_url !== null && item.map_url != '') {
        mapButton = `<a href="${item.map_url}" class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100" target="_blank">${translations.plot_the_route}</a>`;
    }

    item.emails.forEach(function (emailItem) {
        allEmails += `
            <div class="email mb-3"><a href="mailto:${emailItem.item}">${emailItem.item}</a></div>
        `;
    });
    item.phones.forEach(function (phoneItem) {
        allPhones += `
            <div class="phone mb-2"><a href="tel:${phoneItem.item}">${phoneItem.item}</a></div>
        `;
    });

    return `
        <div class="col-12 col-md-6">
            <div class="offices--item">
                <div class="map-body h-100 rounded-top overflow-hidden">
                    <div class="wrap-img h-100">
                        <div class="map">
                            ${item.iframe}
                        </div>
                    </div>
                </div>
                <div class="inner">
                    <div class="row">
                        <div class="col-12 col-xl-auto mb-3 mb-xl-0">
                            <div class="wrap-img">
                                <img src="${'/storage/' + item.image}" alt="img">
                                <div class="city-label">${city}</div>
                            </div>
                        </div>
                        <div class="col-12 col-xl ml-xl-n2">
                            <div class="city-pin mb-3 mt-xl-1">${city}, <br>${street}</div>
                            ${allEmails}
                            ${allPhones}
                            <div class="buttons d-flex flex-wrap">
                                <button type="button" data-toggle="modal" data-target="#popup--sign-up-appointment" class="btn btn-fz-20 btn-blue font-weight-bold w-100">${translations.sign_up_for_for_appointment}</button>
                                ${mapButton}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}