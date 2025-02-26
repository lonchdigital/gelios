import{$ as o}from"./jquery-CqDs7TUd.js";const d=document.head.querySelector('meta[name="app-locale"]').content,f=o("#search-input"),v=o("#accordion-prices-list"),m=o("#laboratories-search-input"),g=o("#accordion-prices-list");document.querySelector("#search-input")&&h();document.querySelector("#laboratories-search-input")&&b();f.on("input",function(){h()});m.on("input",function(){b()});function h(){T(q(),function(e){e.items.length>0?S(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function T(e=null,a,t){const i=document.head.querySelector('meta[name="csrf-token"]').content,l=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${l}/prices-search-filter`,type:"post",data:{_token:i,query:e},dataType:"json"}).done(function(c){a(c)}).fail(function(){t()})}function q(){let e={};return e.search=f.val(),e}function $(){v.html(`<div>${translations.nothing_found}</div>`)}function S(e){let a="",t=1;e.forEach(function(i){a+=I(i,t),t++}),v.html(a)}function I(e,a){let t=e.translations.find(r=>r.locale===d),i=t?t.title:"",l="";e.additional_info.forEach(function(r){let n=r.translations.find(y=>y.locale===d),s=n?n.service:"",p=Math.floor(r.price),u="";r.is_free?u=`<div class="price">${translations.free}</div>`:u=`<div class="price">${p} грн</div>`,l+=`
            <div class="item">
                <div class="name">${s}</div>
                ${u}
            </div>
        `});let c=a===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${c?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="${c?"true":"false"}" aria-controls="collapse-accordion-prices-list-${a}">${i}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse ${c?"show":""}" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${l}
                </div>
            </div>
        </div>
    `}function b(){j(k(),function(e){e.items.length>0?L(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function j(e=null,a,t){const i=document.head.querySelector('meta[name="csrf-token"]').content,l=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${l}/laboratories-prices-search-filter`,type:"post",data:{_token:i,query:e},dataType:"json"}).done(function(c){a(c)}).fail(function(){t()})}function k(){let e={};return e.search=m.val(),e}function x(e,a){let t=e.translations.find(r=>r.locale===d),i=t?t.title:"",l="";e.additional_info.forEach(function(r){let n=r.translations.find(p=>p.locale===d);n&&n.service;let s="";r.is_free?s=`<div class="price">${n.price}</div>`:s=`<div class="price">${n.price}</div>`,l+=`
            <div class="item">
                <div class="name">${i}</div>
                ${s}
            </div>
        `});let c=a===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${c?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="${c?"true":"false"}" aria-controls="collapse-accordion-prices-list-${a}">${i}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse ${c?"show":""}" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${l}
                </div>
            </div>
        </div>
    `}function L(e){let a="",t=1;e.forEach(function(i){a+=x(i,t),t++}),g.html(a)}
