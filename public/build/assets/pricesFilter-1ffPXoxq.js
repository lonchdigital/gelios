import{$ as n}from"./jquery-CqDs7TUd.js";const d=document.head.querySelector('meta[name="app-locale"]').content,f=n("#search-input"),v=n("#accordion-prices-list"),h=n("#laboratories-search-input"),g=n("#accordion-prices-list");document.querySelector("#search-input")&&$();document.querySelector("#laboratories-search-input")&&b();f.on("input",function(){$()});h.on("input",function(){b()});function $(){q(S(),function(e){e.items.length>0?j(e.items):m()},function(){console.error("[Prices]: error during filter.")})}function q(e=null,t,i){const c=document.head.querySelector('meta[name="csrf-token"]').content,r=document.head.querySelector('meta[name="app-url"]').content;n.ajax({url:`${r}/prices-search-filter`,type:"post",data:{_token:c,query:e},dataType:"json"}).done(function(l){t(l)}).fail(function(){i()})}function S(){let e={};return e.search=f.val(),e}function m(){v.html(`<div>${translations.nothing_found}</div>`)}function j(e){let t="",i=1;e.forEach(function(c){t+=k(c,i),i++}),v.html(t)}function k(e,t){let i=e.translations.find(s=>s.locale===d),c=i?i.title:"",r="";e.additional_info.forEach(function(s){let a=s.translations.find(y=>y.locale===d),o=a?a.service:"",u=a?a.price:"",p="";s.is_free?p=`<div class="price">${translations.free}</div>`:p=`<div class="price">${u} грн</div>`,r+=`
            <div class="item">
                <div class="name">${o}</div>
                ${p}
            </div>
        `});let l=t===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${t}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${t}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${t}">${c}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${t}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${t}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${r}
                </div>
            </div>
        </div>
    `}function b(){x(L(),function(e){e.items.length>0?A(e.items):m()},function(){console.error("[Prices]: error during filter.")})}function x(e=null,t,i){const c=document.head.querySelector('meta[name="csrf-token"]').content,r=document.head.querySelector('meta[name="app-url"]').content;n.ajax({url:`${r}/laboratories-prices-search-filter`,type:"post",data:{_token:c,query:e},dataType:"json"}).done(function(l){t(l)}).fail(function(){i()})}function L(){let e={};return e.search=h.val(),e}function _(e,t){let i=e.translations.find(s=>s.locale===d),c=i?i.title:"",r="";e.additional_info.forEach(function(s){let a=s.translations.find(u=>u.locale===d);a&&a.service;let o="";s.is_free?o=`<div class="price">${(a==null?void 0:a.price)??""} ${a!=null&&a.price?translationsPrices.uah:""}</div>`:o=`<div class="price">${(a==null?void 0:a.price)??""} ${a!=null&&a.price?translationsPrices.uah:""}</div>`,r+=`
            <div class="item">
                <div class="name">${(a==null?void 0:a.title)??""}</div>
                ${o}
            </div>
        `});let l=t===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${t}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${t}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${t}">${c}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${t}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${t}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${r}
                </div>
            </div>
        </div>
    `}function A(e){let t="",i=1;e.forEach(function(c){t+=_(c,i),i++}),g.html(t)}
