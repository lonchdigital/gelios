import{$ as l}from"./jquery-CqDs7TUd.js";const o=document.head.querySelector('meta[name="app-locale"]').content,s=l("#search-input"),m=l("#accordion-prices-list");d();s.on("input",function(){d()});function d(){v(h(),function(e){e.items.length>0&&$(e.items)},function(){console.error("[Prices]: error during filter.")})}function v(e=null,a,t){const i=document.head.querySelector('meta[name="csrf-token"]').content,n=document.head.querySelector('meta[name="app-url"]').content;l.ajax({url:`${n}/prices-search-filter`,type:"post",data:{_token:i,query:e},dataType:"json"}).done(function(c){a(c)}).fail(function(){t()})}function h(){let e={};return e.search=s.val(),e}function $(e){let a="",t=1;e.forEach(function(i){a+=y(i,t),t++}),m.html(a)}function y(e,a){let t=e.translations.find(c=>c.locale===o),i=t?t.title:"",n="";return e.additional_info.forEach(function(c){let r=c.translations.find(f=>f.locale===o),p=r?r.service:"",u=Math.floor(c.price);n+=`
            <div class="item">
                <div class="name">${p}</div>
                <div class="price">${u} грн</div>
            </div>
        `}),`
        <div class="card">
            <div class="card-header p-0" id="heading-accordion-prices-list-${a}">
                <div class="h4 mb-0">
                    <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-accordion-prices-list-${a}" aria-expanded="false" aria-controls="collapse-accordion-prices-list-${a}">${i}</div>
                </div>
            </div>
            <div id="collapse-accordion-prices-list-${a}" class="collapse" aria-labelledby="heading-accordion-prices-list-${a}" data-parent="#accordion-prices-list">
                <div class="card-body">
                    ${n}
                </div>
            </div>
        </div>
    `}
