import{$ as s}from"./jquery-CqDs7TUd.js";const d=document.head.querySelector('meta[name="app-locale"]').content,f=s("#search-input"),v=s("#accordion-prices-list"),m=s("#laboratories-search-input"),g=s("#accordion-prices-list");document.querySelector("#search-input")&&h();document.querySelector("#laboratories-search-input")&&b();f.on("input",function(){h()});m.on("input",function(){b()});function h(){T(q(),function(e){e.items.length>0?S(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function T(e=null,t,a){const i=document.head.querySelector('meta[name="csrf-token"]').content,r=document.head.querySelector('meta[name="app-url"]').content;s.ajax({url:`${r}/prices-search-filter`,type:"post",data:{_token:i,query:e},dataType:"json"}).done(function(c){t(c)}).fail(function(){a()})}function q(){let e={};return e.search=f.val(),e}function $(){v.html(`<div>${translations.nothing_found}</div>`)}function S(e){let t="",a=1;e.forEach(function(i){t+=I(i,a),a++}),v.html(t)}function I(e,t){let a=e.translations.find(l=>l.locale===d),i=a?a.title:"",r="";e.additional_info.forEach(function(l){let n=l.translations.find(y=>y.locale===d),o=n?n.service:"",p=n?n.price:"",u="";l.is_free?u=`<div class="price">${translations.free}</div>`:u=`<div class="price">${p} грн</div>`,r+=`
            <div class="item">
                <div class="name">${o}</div>
                ${u}
            </div>
        `});let c=t===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${t}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${c?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${t}" aria-expanded="${c?"true":"false"}" aria-controls="collapse-accordion-prices-list-${t}">${i}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${t}" class="collapse ${c?"show":""}" aria-labelledby="heading-accordion-prices-list-${t}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${r}
                </div>
            </div>
        </div>
    `}function b(){j(k(),function(e){e.items.length>0?L(e.items):$()},function(){console.error("[Prices]: error during filter.")})}function j(e=null,t,a){const i=document.head.querySelector('meta[name="csrf-token"]').content,r=document.head.querySelector('meta[name="app-url"]').content;s.ajax({url:`${r}/laboratories-prices-search-filter`,type:"post",data:{_token:i,query:e},dataType:"json"}).done(function(c){t(c)}).fail(function(){a()})}function k(){let e={};return e.search=m.val(),e}function x(e,t){let a=e.translations.find(l=>l.locale===d),i=a?a.title:"",r="";e.additional_info.forEach(function(l){let n=l.translations.find(p=>p.locale===d);n&&n.service;let o="";l.is_free?o=`<div class="price">${n.price}</div>`:o=`<div class="price">${n.price}</div>`,r+=`
            <div class="item">
                <div class="name">${i}</div>
                ${o}
            </div>
        `});let c=t===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${t}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${c?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${t}" aria-expanded="${c?"true":"false"}" aria-controls="collapse-accordion-prices-list-${t}">${i}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${t}" class="collapse ${c?"show":""}" aria-labelledby="heading-accordion-prices-list-${t}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${r}
                </div>
            </div>
        </div>
    `}function L(e){let t="",a=1;e.forEach(function(i){t+=x(i,a),a++}),g.html(t)}
