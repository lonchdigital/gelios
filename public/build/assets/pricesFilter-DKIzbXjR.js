import{$ as o}from"./jquery-CqDs7TUd.js";const d=document.head.querySelector('meta[name="app-locale"]').content,f=o("#search-input"),v=o("#accordion-prices-list"),m=o("#laboratories-search-input");o("#accordion-laboratories-prices-list");h();f.on("input",function(){h()});m.on("input",function(){S()});function h(){y(g(),function(e){e.items.length>0?T(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function y(e=null,a,i){const t=document.head.querySelector('meta[name="csrf-token"]').content,n=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${n}/prices-search-filter`,type:"post",data:{_token:t,query:e},dataType:"json"}).done(function(l){a(l)}).fail(function(){i()})}function g(){let e={};return e.search=f.val(),e}function $(){v.html(`<div>${translations.nothing_found}</div>`)}function T(e){let a="",i=1;e.forEach(function(t){a+=I(t,i),i++}),v.html(a)}function I(e,a){let i=e.translations.find(c=>c.locale===d),t=i?i.title:"",n="";e.additional_info.forEach(function(c){let r=c.translations.find(b=>b.locale===d),s=r?r.service:"",p=Math.floor(c.price),u="";c.is_free?u=`<div class="price">${translations.free}</div>`:u=`<div class="price">${p} грн</div>`,n+=`
            <div class="item">
                <div class="name">${s}</div>
                ${u}
            </div>
        `});let l=a===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${a}">${t}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${n}
                </div>
            </div>
        </div>
    `}function S(){j(k(),function(e){e.items.length>0?x(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function j(e=null,a,i){console.log(e);const t=document.head.querySelector('meta[name="csrf-token"]').content,n=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${n}/laboratories-prices-search-filter`,type:"post",data:{_token:t,query:e},dataType:"json"}).done(function(l){a(l)}).fail(function(){i()})}function k(){let e={};return e.search=m.val(),e}function q(e,a){let i=e.translations.find(c=>c.locale===d),t=i?i.title:"",n="";e.additional_info.forEach(function(c){let r=c.translations.find(p=>p.locale===d);r&&r.service;let s="";c.is_free?s=`<div class="price">${r.price}</div>`:s=`<div class="price">${r.price}</div>`,n+=`
            <div class="item">
                <div class="name">${t}</div>
                ${s}
            </div>
        `});let l=a===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${l?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="${l?"true":"false"}" aria-controls="collapse-accordion-prices-list-${a}">${t}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse ${l?"show":""}" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${n}
                </div>
            </div>
        </div>
    `}function x(e){let a="",i=1;e.forEach(function(t){a+=q(t,i),i++}),$labolatoriesItemsWrapper.html(a)}
