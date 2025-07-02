import{$ as n}from"./jquery-CqDs7TUd.js";const p=document.head.querySelector('meta[name="app-locale"]').content,f=n("#search-input"),v=n("#accordion-prices-list"),h=n("#laboratories-search-input"),g=n("#accordion-prices-list");document.querySelector("#search-input")&&m();document.querySelector("#laboratories-search-input")&&b();f.on("input",function(){m()});h.on("input",function(){b()});function m(){q(S(),function(e){e.items.length>0?j(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function q(e=null,a,i){const c=document.head.querySelector('meta[name="csrf-token"]').content,r=document.head.querySelector('meta[name="app-url"]').content;n.ajax({url:`${r}/prices-search-filter`,type:"post",data:{_token:c,query:e},dataType:"json"}).done(function(l){a(l)}).fail(function(){i()})}function S(){let e={};return e.search=f.val(),e}function $(){v.html(`<div>${translations.nothing_found}</div>`)}function j(e){let a="",i=1;e.forEach(function(c){a+=k(c,i),i++}),v.html(a)}function k(e,a){let i=e.translations.find(s=>s.locale===p),c=i?i.title:"",r="";e.additional_info.forEach(function(s){let t=s.translations.find(y=>y.locale===p),o=t?t.service:"",d=t?t.price:"",u="";s.is_free?u=`<div class="price">${translations.free}</div>`:i&&i.locale=="en"?u=`<div class="price">${d} UAH</div>`:u=`<div class="price">${d} грн</div>`,r+=`
            <div class="item">
                <div class="name">${o}</div>
                ${u}
            </div>
        `});let l=a===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${a}">${c}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${r}
                </div>
            </div>
        </div>
    `}function b(){x(L(),function(e){e.items.length>0?_(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function x(e=null,a,i){const c=document.head.querySelector('meta[name="csrf-token"]').content,r=document.head.querySelector('meta[name="app-url"]').content;n.ajax({url:`${r}/laboratories-prices-search-filter`,type:"post",data:{_token:c,query:e},dataType:"json"}).done(function(l){a(l)}).fail(function(){i()})}function L(){let e={};return e.search=h.val(),e}function A(e,a){let i=e.translations.find(s=>s.locale===p),c=i?i.title:"",r="";e.additional_info.forEach(function(s){let t=s.translations.find(d=>d.locale===p);t&&t.service;let o="";s.is_free?o=`<div class="price">${translationsPrices.free}</div>`:o=`<div class="price">${(t==null?void 0:t.price)??""} ${t!=null&&t.price?translationsPrices.uah:""}</div>`,r+=`
            <div class="item">
                <div class="name">${(t==null?void 0:t.title)??""}</div>
                ${o}
            </div>
        `});let l=a===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${a}">${c}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${r}
                </div>
            </div>
        </div>
    `}function _(e){let a="",i=1;e.forEach(function(c){a+=A(c,i),i++}),g.html(a)}
