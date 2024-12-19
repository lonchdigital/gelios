import{$ as o}from"./jquery-CqDs7TUd.js";const d=document.head.querySelector('meta[name="app-locale"]').content,p=o("#search-input"),u=o("#accordion-prices-list");f();p.on("input",function(){f()});function f(){$(g(),function(e){e.items.length>0?b(e.items):y()},function(){console.error("[Prices]: error during filter.")})}function $(e=null,t,i){const a=document.head.querySelector('meta[name="csrf-token"]').content,l=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${l}/prices-search-filter`,type:"post",data:{_token:a,query:e},dataType:"json"}).done(function(n){t(n)}).fail(function(){i()})}function g(){let e={};return e.search=p.val(),e}function y(){u.html(`<div>${translations.nothing_found}</div>`)}function b(e){let t="",i=1;e.forEach(function(a){t+=T(a,i),i++}),u.html(t)}function T(e,t){let i=e.translations.find(c=>c.locale===d),a=i?i.title:"",l="";e.additional_info.forEach(function(c){let r=c.translations.find(h=>h.locale===d),v=r?r.service:"",m=Math.floor(c.price),s="";c.is_free?s=`<div class="price">${translations.free}</div>`:s=`<div class="price">${m} грн</div>`,l+=`
            <div class="item">
                <div class="name">${v}</div>
                ${s}
            </div>
        `});let n=t===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${t}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${n?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${t}" aria-expanded="${n?"true":"false"}" aria-controls="collapse-accordion-prices-list-${t}">${a}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${t}" class="collapse ${n?"show":""}" aria-labelledby="heading-accordion-prices-list-${t}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${l}
                </div>
            </div>
        </div>
    `}
