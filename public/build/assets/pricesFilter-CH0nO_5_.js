import{$ as n}from"./jquery-CqDs7TUd.js";const p=document.head.querySelector('meta[name="app-locale"]').content,f=n("#search-input"),v=n("#accordion-prices-list"),h=n("#laboratories-search-input"),g=n("#accordion-prices-list");document.querySelector("#search-input")&&$();document.querySelector("#laboratories-search-input")&&b();f.on("input",function(){$()});h.on("input",function(){b()});function $(){q(S(),function(e){e.items.length>0?j(e.items):m()},function(){console.error("[Prices]: error during filter.")})}function q(e=null,i,t){const c=document.head.querySelector('meta[name="csrf-token"]').content,s=document.head.querySelector('meta[name="app-url"]').content;n.ajax({url:`${s}/prices-search-filter`,type:"post",data:{_token:c,query:e},dataType:"json"}).done(function(l){i(l)}).fail(function(){t()})}function S(){let e={};return e.search=f.val(),e}function m(){v.html(`<div>${translations.nothing_found}</div>`)}function j(e){let i="",t=1;e.forEach(function(c){i+=k(c,t),t++}),v.html(i)}function k(e,i){let t=e.translations.find(r=>r.locale===p),c=t?t.title:"",s="";e.additional_info.forEach(function(r){let a=r.translations.find(y=>y.locale===p),o=a?a.service:"",d=a?a.price:"",u="";r.is_free?u=`<div class="price">${translations.free}</div>`:t&&t.locale=="en"?u=`<div class="price">${d} UAH</div>`:u=`<div class="price">${d} грн</div>`,s+=`
            <div class="item">
                <div class="name">${o}</div>
                ${u}
            </div>
        `});let l=i===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${i}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${i}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${i}">${c}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${i}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${i}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${s}
                </div>
            </div>
        </div>
    `}function b(){x(L(),function(e){e.items.length>0?_(e.items):m()},function(){console.error("[Prices]: error during filter.")})}function x(e=null,i,t){const c=document.head.querySelector('meta[name="csrf-token"]').content,s=document.head.querySelector('meta[name="app-url"]').content;n.ajax({url:`${s}/laboratories-prices-search-filter`,type:"post",data:{_token:c,query:e},dataType:"json"}).done(function(l){i(l)}).fail(function(){t()})}function L(){let e={};return e.search=h.val(),e}function A(e,i){let t=e.translations.find(r=>r.locale===p),c=t?t.title:"",s="";e.additional_info.forEach(function(r){let a=r.translations.find(d=>d.locale===p);a&&a.service;let o="";r.is_free?o=`<div class="price">${(a==null?void 0:a.price)??""} ${a!=null&&a.price?translationsPrices.uah:""}</div>`:o=`<div class="price">${(a==null?void 0:a.price)??""} ${a!=null&&a.price?translationsPrices.uah:""}</div>`,s+=`
            <div class="item">
                <div class="name">${(a==null?void 0:a.title)??""}</div>
                ${o}
            </div>
        `});let l=i===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${i}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${i}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${i}">${c}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${i}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${i}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${s}
                </div>
            </div>
        </div>
    `}function _(e){let i="",t=1;e.forEach(function(c){i+=A(c,t),t++}),g.html(i)}
