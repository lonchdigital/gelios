import{$ as o}from"./jquery-CqDs7TUd.js";const d=document.head.querySelector('meta[name="app-locale"]').content,s=o("#search-input"),u=o("#art-contacts-list");r();s.on("input",function(){r()});function r(){f(m(),function(t){t.items.length>0&&v(t.items)},function(){console.error("[Prices]: error during filter.")})}function f(t=null,e,n){const c=document.head.querySelector('meta[name="csrf-token"]').content,i=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${i}/contacts-search-filter`,type:"post",data:{_token:c,query:t},dataType:"json"}).done(function(l){e(l)}).fail(function(){n()})}function m(){let t={};return t.search=s.val(),t}function v(t){let e="";t.forEach(function(n){e+=p(n)}),u.html(e)}function p(t){let e=t.translations.find(a=>a.locale===d),n=e?e.city:"",c=e?e.street:"",i="",l="";return t.emails.forEach(function(a){i+=`
            <div class="email mb-3"><a href="mailto:${a.item}">${a.item}</a></div>
        `}),t.phones.forEach(function(a){l+=`
            <div class="phone mb-2"><a href="tel:${a.item}">${a.item}</a></div>
        `}),`
        <div class="col-12 col-md-6">
            <div class="offices--item">
                <div class="map-body h-100 rounded-top overflow-hidden">
                    <div class="wrap-img h-100">
                        <div class="map">
                            ${t.iframe}
                        </div>
                    </div>
                </div>
                <div class="inner">
                    <div class="row">
                        <div class="col-12 col-xl-auto mb-3 mb-xl-0">
                            <div class="wrap-img">
                                <img src="${"/storage/"+t.image}" alt="img">
                                <div class="city-label">${n}</div>
                            </div>
                        </div>
                        <div class="col-12 col-xl ml-xl-n2">
                            <div class="city-pin mb-3 mt-xl-1">${n}, <br>${c}</div>
                            ${i}
                            ${l}
                            
                            <div class="buttons d-flex flex-wrap">
                                <a href="##" class="btn btn-fz-20 btn-blue font-weight-bold w-100">Записатись на прийом</a>
                                <a href="##" class="btn btn-fz-20 btn-outline-blue font-weight-bold w-100">Прокласти маршрут</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}
