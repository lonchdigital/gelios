@php
    use Illuminate\Support\Str;

    $mode       = (isset($context) && $context === 'mobile') ? 'mobile' : 'desktop';
    $uid        = 'hxs3_' . Str::random(8);

    $target     = route('search.index');
    $suggestUrl = \Illuminate\Support\Facades\Route::has('search.suggest') ? route('search.suggest') : null;
    $sprite     = Vite::asset(config('app.icons_path'));
@endphp

<div id="{{ $uid }}"
     class="hxs3 {{ $mode === 'mobile' ? 'hxs3--mob' : 'hxs3--desk' }}"
     data-mode="{{ $mode }}"
     data-search-url="{{ $target }}"
     @if($suggestUrl) data-suggest-url="{{ $suggestUrl }}" @endif>

  {{-- триггер (в мобиле скрыт) --}}
  <button type="button" class="hxs3__toggle" aria-label="{{ __('ui.search.open') }}">
    <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
      <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l4.5 4.49 1.49-1.49L15.5 14Zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14Z"/>
    </svg>
  </button>

  {{-- панель поиска --}}
  <div class="hxs3__panel" aria-hidden="true">
    <form class="hxs3__form" method="get" action="{{ $target }}" autocomplete="off">
      <div class="hxs3__icon">
        <svg width="18" height="18" aria-hidden="true">
          <use xlink:href="{{ $sprite }}#i-search"></use>
        </svg>
      </div>
      <input id="{{ $uid }}_input" class="hxs3__input" type="search" name="q" placeholder="{{ __('ui.search.placeholder') }}">
      {{-- старый параметр оставляем в верстке, но отключим в JS перед submit --}}
      <input type="hidden" id="{{ $uid }}_mirror" name="search" value="">
      <button class="hxs3__go" type="submit">{{ __('ui.search.find') }}</button>
    </form>
  </div>

  {{-- подсказки --}}
  <div class="hxs3__suggest" id="{{ $uid }}_suggest" hidden></div>
</div>

<style>
/* ===== Helyos Header Search v3 (изолировано) ===== */
.hxs3{ position:relative; z-index:10050; }
.hxs3 *{ box-sizing:border-box; }

/* триггер */
.hxs3__toggle{
  display:inline-flex; align-items:center; justify-content:center;
  width:42px; height:42px; border-radius:999px; cursor:pointer;
  background:#fff; border:1px solid #E6EEF7; box-shadow:0 10px 25px rgba(44,84,118,.08);
}
.hxs3__toggle:hover{ filter:brightness(.98); }

/* --- DESKTOP --- */
.hxs3--desk{ display:inline-block; width:42px; }

.hxs3--desk .hxs3__panel{
  position:absolute; top:50%; right:0; margin-right:52px;
  width:360px; transform:translateY(-50%) scaleX(0); transform-origin:right center;
  pointer-events:none; transition:transform .22s ease;
  background:#fff; border:1px solid #E6EEF7; border-radius:16px;
  box-shadow:0 10px 25px rgba(44,84,118,.08);
}
.hxs3--desk .hxs3__panel.open{ transform:translateY(-50%) scaleX(1); pointer-events:auto; }
@media (max-width:1400px){ .hxs3--desk .hxs3__panel{ width:300px; } }
@media (max-width:1200px){ .hxs3--desk .hxs3__panel{ width:260px; } }

.hxs3--desk .hxs3__suggest{
  position:absolute; right:0; margin-right:52px; top:calc(50% + 30px);
  width:360px; background:#fff; border:1px solid #E6EEF7; border-radius:16px;
  box-shadow:0 12px 32px rgba(44,84,118,.12);
  max-height:500px;                 /* ограничение высоты */
  overflow:auto;                    /* скролл после 500px */
  z-index:10061;
}
@media (max-width:1400px){ .hxs3--desk .hxs3__suggest{ width:300px; } }
@media (max-width:1200px){ .hxs3--desk .hxs3__suggest{ width:260px; } }

/* общий вид формы */
.hxs3__form{
  display:flex; align-items:center; gap:10px;
  height:46px; padding:6px 10px 6px 14px; background:#fff; border-radius:999px;
}
.hxs3__icon{ display:flex; align-items:center; opacity:.65; }
.hxs3__input{
  flex:1 1 auto; height:40px; border:0; outline:none; background:transparent;
  font-size:15px; color:#2C3E50;
}
.hxs3__input::placeholder{ color:#98A6B5; }
.hxs3__go{
  height:36px; padding:0 14px; border:0; border-radius:999px; background:#2f80ed;
  color:#fff; font-weight:600; cursor:pointer;
}
.hxs3__go:hover{ filter:brightness(.95); }

/* элементы подсказок */
.hxs3__item{
  display:flex; align-items:center; justify-content:space-between;
  gap:10px; padding:10px 14px; color:#1F2D3D; text-decoration:none;
}
.hxs3__item:hover, .hxs3__item.is-active{ background:#F5FAFF; }
.hxs3__item-title{ font-weight:600; line-height:1.25; }
.hxs3__item-sub{ font-size:12px; color:#7C8B99; }
.hxs3__item-tag{ font-size:11px; padding:2px 6px; border-radius:999px; background:#F0F6FF; white-space:nowrap; }
.hxs3__suggest[hidden]{ display:none !important; }

/* цена справа */
.hxs3__item-right{ margin-left:12px; white-space:nowrap; font-weight:700; }

/* --- MOBILE --- */
.hxs3--mob{ display:block; width:100%; }
.hxs3--mob .hxs3__toggle{ display:none; }
.hxs3--mob .hxs3__panel{
  position:static; margin:12px 0 8px 0; width:100%;
  background:#fff; border:1px solid #E6EEF7; border-radius:16px;
  box-shadow:0 6px 18px rgba(44,84,118,.08); display:block !important;
}
.hxs3--mob .hxs3__form{ margin:10px; }
.hxs3--mob .hxs3__suggest{
  position:static; width:100%; margin-top:8px;
  background:#fff; border:1px solid #E6EEF7; border-radius:16px;
  box-shadow:0 12px 32px rgba(44,84,118,.12);
  max-height:min(500px, 70vh);
  overflow:auto;
}
</style>

<script>
(function(){
  const root    = document.getElementById(@json($uid));
  if(!root) return;

  const mode    = root.dataset.mode;
  const btn     = root.querySelector('.hxs3__toggle');
  const panel   = root.querySelector('.hxs3__panel');
  const form    = root.querySelector('.hxs3__form');
  const input   = root.querySelector('#{{ $uid }}_input');
  const mirror  = root.querySelector('#{{ $uid }}_mirror');
  const box     = root.querySelector('#{{ $uid }}_suggest');

  const suggestUrl = root.dataset.suggestUrl || null;

  const esc = s => (s||'').replace(/[&<>"]/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[m]));

  function open(){ panel.classList.add('open'); panel.setAttribute('aria-hidden','false'); setTimeout(()=>input.focus(),0); }
  function close(){ panel.classList.remove('open'); panel.setAttribute('aria-hidden','true'); hideSuggest(); }

  if(mode === 'desktop'){
    btn.addEventListener('click', () => panel.classList.contains('open') ? close() : open());
    document.addEventListener('click', e => { if(!root.contains(e.target)) close(); });
    document.addEventListener('keydown', e => { if(e.key === 'Escape') close(); });
  }else{
    open();
  }

  // префилл из URL (?q= или ?search=)
  (function(){
    try{
      const u = new URL(window.location.href);
      const v = (u.searchParams.get('q') || u.searchParams.get('search') || '').trim();
      if(v){ input.value = v; }
    }catch(_){}
  })();

  // submit — только ?q=, без дублирования &search=
  form.addEventListener('submit', e=>{
    const q = (input.value || '').trim();
    if(!q){ e.preventDefault(); return; }
    if(mirror){ mirror.removeAttribute('name'); } // убираем старый параметр
    hideSuggest();
  });

  // ===== AJAX подсказки =====
  let t=null, items=[], idx=-1;

  function hideSuggest(){ box.hidden = true; box.innerHTML=''; items=[]; idx=-1; }
  function setActive(i){
    box.querySelectorAll('.hxs3__item').forEach(el=>el.classList.remove('is-active'));
    idx = i;
    if(idx>=0){
      const el = box.querySelector(`.hxs3__item[data-idx="${idx}"]`);
      el && el.classList.add('is-active');
    }
  }

  function typeTitle(t){
    if(!t) return '';
    switch(t){
      case 'doctor': return @json(__('ui.search.tag.doctor'));
      case 'service': return @json(__('ui.search.tag.service'));
      case 'article': return @json(__('ui.search.tag.article'));
      case 'price': return @json(__('ui.search.tag.price'));
      default: return @json(__('ui.search.tag.section'));
    }
  }

  function priceOf(it){
    return it?.price_text || it?.price || (it?.type === 'price' ? it.subtitle : null);
  }

  function render(list){
    if(!Array.isArray(list) || list.length===0){ hideSuggest(); return; }
    items = list; idx = -1;
    box.innerHTML = list.map((it,i)=>{
      const price = priceOf(it);
      const right = price
        ? `<div class="hxs3__item-right">${esc(price)}</div>`
        : (it.type ? `<span class="hxs3__item-tag">${typeTitle(it.type)}</span>` : '');
      return `
        <a class="hxs3__item" data-idx="${i}" href="${it.url}">
          <div>
            <div class="hxs3__item-title">${esc(it.title||'')}</div>
            ${it.subtitle && !price ? `<div class="hxs3__item-sub">${esc(it.subtitle)}</div>` : ''}
          </div>
          ${right}
        </a>`;
    }).join('');
    box.hidden = false;

    box.querySelectorAll('.hxs3__item').forEach(el=>{
      el.addEventListener('mouseenter', ()=> setActive(+el.dataset.idx));
      el.addEventListener('mouseleave', ()=> setActive(-1));
    });
  }

  async function fetchSuggest(q){
    try{
      const r = await fetch(suggestUrl + '?q=' + encodeURIComponent(q), {
        headers: { 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' }
      });
      if(!r.ok){ hideSuggest(); return; }
      const data = await r.json();
      if(!Array.isArray(data) || data.length===0){ hideSuggest(); return; }
      render(data);
    }catch(_){ hideSuggest(); }
  }

  input.addEventListener('input', ()=>{
    const q = (input.value || '').trim();
    clearTimeout(t);
    if(q.length < 2 || !suggestUrl){ hideSuggest(); return; }
    t = setTimeout(()=>fetchSuggest(q), 220);
  });

  /* Важно: подсказки НЕ автозагружаем при заходе на /search
     + прячем их при загрузке/возврате/потере фокуса */
  hideSuggest();
  window.addEventListener('pageshow', hideSuggest);
  input.addEventListener('blur', ()=> setTimeout(hideSuggest, 120));

  // клик по подсказке — подставляем текст и идём по ссылке (только ?q=)
  box.addEventListener('click', (e)=>{
    const a = e.target.closest('.hxs3__item');
    if(!a) return;
    const i = +a.dataset.idx;
    const it = items[i];
    if(it && it.title){ input.value = it.title; }
    try{
      const u = new URL(a.getAttribute('href'), window.location.origin);
      u.searchParams.delete('search');          // убираем дубль
      if(!u.searchParams.get('q') && it?.title){
        u.searchParams.set('q', it.title);
      }
      e.preventDefault();
      window.location.href = u.toString();
    }catch(_){}
  });

  // навигация стрелками / Enter
  input.addEventListener('keydown', e=>{
    if(!box.hidden){
      if(e.key==='ArrowDown'){ e.preventDefault(); setActive(Math.min(idx+1, items.length-1)); return; }
      if(e.key==='ArrowUp'){ e.preventDefault(); setActive(Math.max(idx-1, -1)); return; }
      if(e.key==='Enter' && idx>=0){
        e.preventDefault();
        const a = box.querySelector(`.hxs3__item[data-idx="${idx}"]`);
        if(a){ a.click(); }
      }
    }
  });
})();
</script>
