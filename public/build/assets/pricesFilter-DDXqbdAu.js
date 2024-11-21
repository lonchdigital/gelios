import{$ as o}from"./jquery-CqDs7TUd.js";const s=document.head.querySelector('meta[name="app-locale"]').content,d=o("#search-input"),p=o("#accordion-prices-list");u();d.on("input",function(){u()});function u(){h($(),function(e){e.items.length>0?y(e.items):g()},function(){console.error("[Prices]: error during filter.")})}function h(e=null,t,a){const i=document.head.querySelector('meta[name="csrf-token"]').content,c=document.head.querySelector('meta[name="app-url"]').content;o.ajax({url:`${c}/prices-search-filter`,type:"post",data:{_token:i,query:e},dataType:"json"}).done(function(n){t(n)}).fail(function(){a()})}function $(){let e={};return e.search=d.val(),e}function g(){p.html(`<div>${translations.nothing_found}</div>`)}function y(e){let t="",a=1;e.forEach(function(i){t+=b(i,a),a++}),p.html(t)}function b(e,t){let a=e.translations.find(l=>l.locale===s),i=a?a.title:"",c="";e.additional_info.forEach(function(l){let r=l.translations.find(v=>v.locale===s),f=r?r.service:"",m=Math.floor(l.price);c+=`
            <div class="item">
                <div class="name">${f}</div>
                <div class="price">${m} грн</div>
            </div>
        `});let n=t===1;return`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${t}">
                <div class="h4 mb-0">
                    <div class="btn btn-link ${n?"":"collapsed"}" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${t}" aria-expanded="${n?"true":"false"}" aria-controls="collapse-accordion-prices-list-${t}">${i}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${t}" class="collapse ${n?"show":""}" aria-labelledby="heading-accordion-prices-list-${t}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${c}
                </div>
            </div>
        </div>
    `}
