<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// цены
use App\Models\Page;
use App\Models\Test;
use App\Services\Site\PricesService;

class SearchController extends Controller
{
    /* ==================== ВСПОМОГАТЕЛЬНОЕ: кеш схемы и колонок ==================== */

    private function tableExistsCached(string $table): bool
    {
        return Cache::remember("schema:exists:$table", 3600, function () use ($table) {
            return Schema::hasTable($table);
        });
    }

    private function columnsCached(string $table): array
    {
        if (!$this->tableExistsCached($table)) return [];
        return Cache::remember("schema:cols:$table", 3600, function () use ($table) {
            return Schema::getColumnListing($table);
        });
    }

    /** Выдернуть массив строк из произвольного JSON-пейлоада */
    private function pluckRowsFromPayload($payload): array
    {
        if (!is_array($payload)) return [];
        foreach (['data','items','services','prices','rows','list','result','results'] as $k) {
            if (isset($payload[$k]) && is_array($payload[$k])) return $payload[$k];
        }
        if (isset($payload[0]) && is_array($payload[0])) return $payload;
        if (count($payload) === 1) {
            $v = reset($payload);
            return is_array($v) ? $this->pluckRowsFromPayload($v) : [];
        }
        return [];
    }

    /** Вызов маршрута как AJAX (чтобы сработал $request->ajax()) */
    private function dispatchAjax(string $method, string $uri, array $params, Request $original): ?array
    {
        $req = Request::create($uri, strtoupper($method), $params, [], [], [
            'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
            'HTTP_ACCEPT'           => 'application/json',
            'HTTP_REFERER'          => $original->fullUrl(),
        ]);
        $req->setLaravelSession($original->session());
        foreach (['cookie','authorization'] as $h) {
            if ($original->headers->has($h)) {
                $req->headers->set($h, $original->headers->get($h));
            }
        }
        $resp = Route::dispatch($req);
        if (method_exists($resp, 'getStatusCode') && $resp->getStatusCode() >= 200 && $resp->getStatusCode() < 400) {
            $json = json_decode($resp->getContent(), true);
            return is_array($json) ? $json : null;
        }
        return null;
    }

    /** Формат гривны кратко */
    private function fmtUAH($value): string
    {
        return number_format((float)$value, 0, '.', ' ') . ' ₴';
    }

    /** Страница прайса (пытаемся найти) */
    private function findPricesPage(): ?Page
    {
        return Page::query()
            ->whereIn('slug', ['prices','tsiny','ciny','ceni','prajs','prays'])
            ->orWhere('template', 'prices')
            ->orWhere('type', 'prices')
            ->first();
    }

    /** Собрать URL без дублей параметров (только ?q=) */
    private function buildUrl(string $base, array $params = []): string
    {
        $qs = [];
        if (!empty($params['q'])) $qs['q'] = $params['q'];
        $sep = str_contains($base, '?') ? '&' : '?';
        return $qs ? ($base . $sep . http_build_query($qs)) : $base;
    }

    /** Цены через PricesService (как на странице прайса) — с кешем */
    private function fetchPricesViaService(Request $original, string $locale, string $q): array
    {
        if ($q === '') return [];
        $key = 'prices:svc:' . $locale . ':' . md5(mb_strtolower($q));

        return Cache::remember($key, 120, function () use ($original, $locale, $q) {
            try {
                $page = $this->findPricesPage();
                if (!$page) return [];

                /** @var PricesService $svc */
                $svc = app(PricesService::class);

                // сервис ждёт query[search]
                $fake = Request::create('/', 'GET', ['query' => ['search' => $q]]);
                $data = $svc->getFilteredItems($fake, $page);
                if (!is_array($data) || empty($data['items'])) return [];

                $out = [];
                foreach ($data['items'] as $item) {
                    $prices = $item->additional_info ?? $item->prices ?? [];
                    foreach ($prices as $p) {
                        // название из перевода цены
                        $title = null;
                        if (isset($p->translations)) {
                            $tr = $p->translations->firstWhere('locale', $locale)
                                ?? $p->translations->firstWhere('lang', $locale)
                                ?? $p->translations->first();
                            if ($tr && isset($tr->service)) $title = $tr->service;
                        }
                        $title = $title ?: ($p->service ?? $p->title ?? $item->title ?? null);
                        if (!$title) continue;

                        $val = $p->price ?? $p->amount ?? $p->value ?? null;
                        if (is_string($val)) $val = (float)preg_replace('/[^\d\.]/', '', $val);

                        $out[] = ['title' => (string)$title, 'price' => $val];
                        if (count($out) >= 20) break 2;
                    }
                }
                return $out;
            } catch (\Throwable $e) {
                return [];
            }
        });
    }

    /** Eloquent-fallback напрямую по Test -> prices.translations — с кешем */
    private function fetchPricesViaEloquent(string $locale, string $q): array
    {
        if ($q === '' || !class_exists(Test::class)) return [];
        $key = 'prices:elo:' . $locale . ':' . md5(mb_strtolower($q));

        return Cache::remember($key, 120, function () use ($locale, $q) {
            try {
                $rx = '.*' . preg_replace('/\s+/', '\s*', preg_quote($q, '/')) . '.*';

                $items = Test::query()
                    ->with(['prices.translations', 'translations'])
                    ->when($q !== '', function ($qq) use ($rx) {
                        $qq->where(function ($w) use ($rx) {
                            $w->whereHas('translations', function ($t) use ($rx) {
                                $t->where('title', 'REGEXP', $rx);
                            })->orWhereHas('prices.translations', function ($t) use ($rx) {
                                $t->where('service', 'REGEXP', $rx);
                            });
                        });
                    })
                    ->limit(10)
                    ->get();

                $out = [];
                foreach ($items as $item) {
                    foreach ($item->prices as $p) {
                        $tr = $p->translations->firstWhere('locale', $locale)
                            ?? $p->translations->firstWhere('lang', $locale)
                            ?? $p->translations->first();
                        $title = ($tr->service ?? null) ?: ($p->service ?? null);
                        if (!$title && $item->translations && $item->translations->first()) {
                            $title = $item->translations->first()->title;
                        }
                        if (!$title) continue;

                        $val = $p->price ?? $p->amount ?? $p->value ?? null;
                        if (is_string($val)) $val = (float)preg_replace('/[^\d\.]/', '', $val);

                        $out[] = ['title' => (string)$title, 'price' => $val];
                        if (count($out) >= 20) break 2;
                    }
                }
                return $out;
            } catch (\Throwable $e) {
                return [];
            }
        });
    }

    /** Общая страница результатов: /search?q=... */
    public function index(Request $request)
    {
        // Снижаем расход памяти на больших нагрузках
        DB::connection()->disableQueryLog();

        // Страховка на случай, если middleware не подключили: тут тоже строгая канонизация
        if ($request->query->has('search')) {
            $q      = trim((string)$request->query('q', ''));
            $legacy = trim((string)$request->query('search', ''));
            $canonQ = ($q !== '') ? $q : $legacy;
            $target = $request->url() . ($canonQ !== '' ? ('?q=' . urlencode($canonQ)) : '');
            if ($request->fullUrl() !== $target) {
                return redirect()->to($target, 301);
            }
        }

        $q = trim((string)$request->query('q', ''));
        if ($q === '') {
            return view('search.index', [
                'q'      => '',
                'groups' => ['doctors'=>[], 'services'=>[], 'articles'=>[], 'prices'=>[]],
            ]);
        }

        $locale    = LaravelLocalization::getCurrentLocale();   // ru / uk / ua / en
        $altLocale = $locale === 'uk' ? 'ua' : ($locale === 'ua' ? 'uk' : $locale);
        App::setLocale($locale);
        $qKey      = mb_strtolower($q);

        // 45 сек крошечного кеша на горячем пути
        $groups = Cache::remember('search:v3:' . $locale . ':' . md5($qKey), 45, function () use ($q, $locale, $altLocale) {
            $like   = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
            $L = [
                'doctor'  => __('ui.search.tag.doctor'),
                'service' => __('ui.search.tag.service'),
                'article' => __('ui.search.tag.article'),
                'price'   => __('ui.search.tag.price'),
            ];

            $groups = ['doctors'=>[], 'services'=>[], 'articles'=>[], 'prices'=>[]];

            /* ------------------- ВРАЧИ ------------------- */
            if ($this->tableExistsCached('doctors')) {
                $dc = $this->columnsCached('doctors');
                $tt = null;
                foreach (['doctor_translations','doctors_translations'] as $t) {
                    if ($this->tableExistsCached($t)) { $tt = $t; break; }
                }

                if ($tt) {
                    $tc       = $this->columnsCached($tt);
                    $nameCols = array_values(array_intersect($tc, ['name','title','full_name']));
                    $posCols  = array_values(array_intersect($tc, ['position','profession','specialty']));
                    $slugCols = array_values(array_intersect($tc, ['slug']));
                    $localeCol= in_array('locale',$tc,true) ? 'locale' : (in_array('lang',$tc,true) ? 'lang' : null);

                    $q1 = DB::table("$tt as tt")->join('doctors as d','d.id','=','tt.doctor_id');

                    if ($localeCol) {
                        $q1->where(function($qq) use ($localeCol,$locale,$altLocale){
                            $qq->where("tt.$localeCol",$locale);
                            if ($altLocale !== $locale) $qq->orWhere("tt.$localeCol",$altLocale);
                        });
                    }

                    $q1->where(function($qq) use ($nameCols,$posCols,$like){
                        foreach ($nameCols as $c) $qq->orWhere("tt.$c",'like',$like);
                        foreach ($posCols  as $c) $qq->orWhere("tt.$c",'like',$like);
                        if (!$nameCols && !$posCols) {
                            $qq->orWhere('tt.name','like',$like)->orWhere('tt.title','like',$like)->orWhere('tt.position','like',$like);
                        }
                    });

                    $select = ['d.id'];
                    $select[] = $nameCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$nameCols)).') as t_name') : DB::raw("'" . $L['doctor'] . "' as t_name");
                    $select[] = $posCols  ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$posCols)).') as t_pos') : DB::raw('NULL as t_pos');
                    $select[] = $slugCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$slugCols)).') as t_slug') : (in_array('slug',$dc,true) ? 'd.slug as t_slug' : DB::raw('NULL as t_slug'));

                    foreach ($q1->select($select)->limit(10)->get() as $r) {
                        $url = (isset($r->t_slug) && $r->t_slug && Route::has('doctors.show'))
                            ? route('doctors.show', ['doctor' => $r->t_slug])
                            : (Route::has('doctors.index') ? route('doctors.index', ['q'=>$q]) : url('/'));
                        $groups['doctors'][] = [
                            'title'    => $r->t_name ?: $L['doctor'],
                            'subtitle' => $r->t_pos ?: null,
                            'url'      => $url,
                        ];
                    }
                } else {
                    $pick = function(array $cands) use ($dc) { foreach ($cands as $c) if (in_array($c,$dc,true)) return $c; return null; };
                    $nameCol = $pick(["name_{$locale}","title_{$locale}","full_name_{$locale}","name_{$altLocale}","title_{$altLocale}","full_name_{$altLocale}","name","title","full_name"]);
                    $posCol  = $pick(["position_{$locale}","profession_{$locale}","specialty_{$locale}",
                                      "position_{$altLocale}","profession_{$altLocale}","specialty_{$altLocale}",
                                      "position","profession","specialty"]);
                    $slugCol = in_array('slug',$dc,true) ? 'slug' : null;

                    $q2 = DB::table('doctors')->where(function($qq) use ($nameCol,$posCol,$like){
                        if ($nameCol) $qq->orWhere($nameCol,'like',$like);
                        if ($posCol)  $qq->orWhere($posCol,'like',$like);
                        if (!$nameCol && !$posCol) $qq->orWhere('name','like',$like)->orWhere('title','like',$like);
                    })->limit(10)->get();

                    foreach ($q2 as $r) {
                        $title = $nameCol ? ($r->{$nameCol} ?? null) : ($r->name ?? $r->title ?? $L['doctor']);
                        $subtitle = $posCol ? ($r->{$posCol} ?? null) : ($r->position ?? null);
                        $slug = $slugCol ? ($r->{$slugCol} ?? null) : null;
                        $url  = $slug && Route::has('doctors.show') ? route('doctors.show',['doctor'=>$slug])
                             : (Route::has('doctors.index') ? route('doctors.index',['q'=>$q]) : url('/'));
                        $groups['doctors'][] = ['title'=>$title,'subtitle'=>$subtitle,'url'=>$url];
                    }
                }
            }

            /* ------------------- УСЛУГИ / НАПРАВЛЕНИЯ ------------------- */
            $mainTable = null;
            foreach (['services','directions','categories'] as $t) {
                if ($this->tableExistsCached($t)) { $mainTable = $t; break; }
            }
            if ($mainTable) {
                $tt = null;
                foreach (["{$mainTable}_translations",'service_translations','services_translations','direction_translations','directions_translations','category_translations','categories_translations'] as $t) {
                    if ($this->tableExistsCached($t)) { $tt = $t; break; }
                }

                if ($tt) {
                    $tc = $this->columnsCached($tt); $mc = $this->columnsCached($mainTable);
                    $localeCol = in_array('locale',$tc,true) ? 'locale' : (in_array('lang',$tc,true) ? 'lang' : null);

                    $fk = null;
                    foreach ($tc as $c) {
                        if (Str::endsWith($c,'_id')) {
                            if ($c === Str::singular($mainTable).'_id' || in_array($c,['service_id','direction_id','category_id'])) { $fk = $c; break; }
                        }
                    }

                    if ($fk) {
                        $nameCols  = array_values(array_intersect($tc, ['name','title']));
                        $descCols  = array_values(array_intersect($tc, ['short','excerpt','description']));
                        $slugCols  = array_values(array_intersect($tc, ['slug']));
                        $fullPathT = in_array('full_path',$tc,true) ? 'full_path' : null;
                        $fullPathM = in_array('full_path',$mc,true) ? 'full_path' : null;

                        $q3 = DB::table("$tt as tt")->join("$mainTable as m","m.id","=","tt.$fk");

                        if ($localeCol) {
                            $q3->where(function($qq) use ($localeCol,$locale,$altLocale){
                                $qq->where("tt.$localeCol",$locale);
                                if ($altLocale !== $locale) $qq->orWhere("tt.$localeCol",$altLocale);
                            });
                        }

                        $q3->where(function($qq) use ($nameCols,$descCols,$like){
                            foreach ($nameCols as $c) $qq->orWhere("tt.$c",'like',$like);
                            foreach ($descCols as $c) $qq->orWhere("tt.$c",'like',$like);
                            if (!$nameCols && !$descCols) {
                                $qq->orWhere('tt.name','like',$like)->orWhere('tt.title','like',$like)->orWhere('tt.description','like',$like);
                            }
                        });

                        $select = ['m.id'];
                        $select[] = $nameCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$nameCols)).') as t_name') : DB::raw("'" . $L['service'] . "' as t_name");
                        $select[] = $descCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$descCols)).') as t_desc') : DB::raw('NULL as t_desc');
                        if ($slugCols) $select[] = DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$slugCols)).') as t_slug');
                        if ($fullPathT) $select[] = "tt.$fullPathT as t_path";
                        if (!$slugCols && in_array('slug',$mc,true)) $select[] = "m.slug as t_slug_m";
                        if (!$fullPathT && $fullPathM) $select[] = "m.$fullPathM as t_path_m";

                        foreach ($q3->select($select)->limit(10)->get() as $r) {
                            $title = $r->t_name ?: $L['service'];
                            $subtitle = $r->t_desc ? Str::limit($r->t_desc, 120) : null;

                            $url = $r->t_path ?? $r->t_path_m ?? null;
                            if (!$url) {
                                $slug = $r->t_slug ?? $r->t_slug_m ?? null;
                                if ($slug) {
                                    if (Route::has('directions.show'))      $url = route('directions.show',['slug'=>$slug]);
                                    elseif (Route::has('services.show'))     $url = route('services.show',['slug'=>$slug]);
                                    elseif (Route::has("$mainTable.show"))   $url = route("$mainTable.show",['slug'=>$slug]);
                                }
                            }
                            if (!$url) {
                                if (Route::has('directions.page'))      $url = route('directions.page');
                                elseif (Route::has('services.index'))   $url = route('services.index');
                                else                                    $url = url('/');
                            }

                            $groups['services'][] = ['title'=>$title,'subtitle'=>$subtitle,'url'=>$url];
                        }
                    }
                }
            }

            /* ------------------- СТАТЬИ ------------------- */
            $articleTable = null;
            foreach (['articles','posts','blog_posts'] as $t) {
                if ($this->tableExistsCached($t)) { $articleTable = $t; break; }
            }
            if ($articleTable) {
                $tt = null;
                foreach (["{$articleTable}_translations",'article_translations','articles_translations','post_translations','posts_translations'] as $t) {
                    if ($this->tableExistsCached($t)) { $tt = $t; break; }
                }

                if ($tt) {
                    $tc = $this->columnsCached($tt); $mc = $this->columnsCached($articleTable);
                    $localeCol = in_array('locale',$tc,true) ? 'locale' : (in_array('lang',$tc,true) ? 'lang' : null);
                    $fk = null;
                    foreach ($tc as $c) {
                        if (Str::endsWith($c,'_id')) {
                            if ($c === Str::singular($articleTable).'_id' || in_array($c,['article_id','post_id'])) { $fk = $c; break; }
                        }
                    }
                    $titleCols = array_values(array_intersect($tc, ['title','name']));
                    $textCols  = array_values(array_intersect($tc, ['excerpt','description','body']));
                    $slugCols  = array_values(array_intersect($tc, ['slug']));
                    $pubCol    = in_array('published',$mc,true) ? 'published' : (in_array('is_published',$mc,true) ? 'is_published' : null);

                    if ($fk) {
                        $q4 = DB::table("$tt as tt")->join("$articleTable as a","a.id","=","tt.$fk");
                        if ($localeCol) {
                            $q4->where(function($qq) use ($localeCol,$locale,$altLocale){
                                $qq->where("tt.$localeCol",$locale);
                                if ($altLocale !== $locale) $qq->orWhere("tt.$localeCol",$altLocale);
                            });
                        }
                        if ($pubCol) $q4->where("a.$pubCol", 1);

                        $q4->where(function($qq) use ($titleCols,$textCols,$like){
                            foreach ($titleCols as $c) $qq->orWhere("tt.$c",'like',$like);
                            foreach ($textCols  as $c) $qq->orWhere("tt.$c",'like',$like);
                            if (!$titleCols && !$textCols) {
                                $qq->orWhere('tt.title','like',$like)->orWhere('tt.excerpt','like',$like);
                            }
                        });

                        $select = ['a.id'];
                        $select[] = $titleCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$titleCols)).') as t_title') : DB::raw("'" . $L['article'] . "' as t_title");
                        $select[] = $textCols  ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$textCols)).') as t_text')  : DB::raw('NULL as t_text');
                        if ($slugCols) $select[] = DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$slugCols)).') as t_slug');
                        if (in_array('slug',$mc,true)) $select[] = "a.slug as t_slug_m";

                        foreach ($q4->select($select)->limit(8)->get() as $r) {
                            $slug = $r->t_slug ?? $r->t_slug_m ?? null;
                            $url  = $slug && Route::has('articles.show')
                                    ? route('articles.show',['slug'=>$slug])
                                    : (Route::has('articles.index') ? route('articles.index',['q'=>$q]) : url('/'));
                            $groups['articles'][] = [
                                'title'    => $r->t_title ?: $L['article'],
                                'subtitle' => $r->t_text ? Str::limit($r->t_text, 120) : null,
                                'url'      => $url,
                            ];
                        }
                    }
                }
            }

            /* ------------------- ПРАЙС ------------------- */
            $gotPrices = false;

            // 0) Через PricesService
            $rows = $this->fetchPricesViaService(request(), $locale, $q);
            if (!$rows) {
                // 0b) Eloquent-fallback
                $rows = $this->fetchPricesViaEloquent($locale, $q);
            }
            if ($rows) {
                foreach ($rows as $r) {
                    $title = $r['title'];
                    $price = $r['price'];

                    $base = Route::has('prices.page') ? route('prices.page') : url('/prices');
                    $url  = $this->buildUrl($base, ['q' => $title]);

                    $groups['prices'][] = [
                        'title'    => $title,
                        'subtitle' => isset($price) ? $this->fmtUAH($price) : null,
                        'url'      => $url,
                    ];
                    if (count($groups['prices']) >= 10) break;
                }
                $gotPrices = true;
            }

            // 1) Если вдруг всё ещё пусто — пробуем /prices-search-filter (НО: query[search])
            if (!$gotPrices) {
                try {
                    $json = $this->dispatchAjax('POST', '/prices-search-filter', [
                        'query' => ['search' => $q],
                        'limit' => 10,
                        'lang'  => $locale,
                    ], request());

                    if (is_array($json)) {
                        $rows = $this->pluckRowsFromPayload($json);
                        foreach ($rows as $r) {
                            $title = $r["title_$locale"] ?? $r["name_$locale"]
                                  ?? $r['title'] ?? $r['name'] ?? $r['service'] ?? $L['price'];
                            $price = $r['price'] ?? $r['amount'] ?? $r['value'] ?? null;

                            $base = Route::has('prices.page') ? route('prices.page') : url('/prices');
                            $url  = $this->buildUrl($base, ['q' => $title]);

                            $groups['prices'][] = [
                                'title'    => $title,
                                'subtitle' => isset($price) ? $this->fmtUAH($price) : null,
                                'url'      => $url,
                            ];
                            if (count($groups['prices']) >= 10) break;
                        }
                    }
                } catch (\Throwable $e) {}
            }

            return $groups;
        });

        return view('search.index', [
            'q'      => $q,
            'groups' => $groups,
        ]);
    }

    /** AJAX подсказки — [{title, subtitle, url, type}] */
    public function suggest(Request $request)
    {
        DB::connection()->disableQueryLog();

        $q = trim((string)$request->query('q', ''));
        if (mb_strlen($q) < 2) return response()->json([]);

        $locale    = LaravelLocalization::getCurrentLocale();
        $altLocale = $locale === 'uk' ? 'ua' : ($locale === 'ua' ? 'uk' : $locale);
        App::setLocale($locale);
        $qKey = mb_strtolower($q);

        $out = Cache::remember('search:suggest:v3:' . $locale . ':' . md5($qKey), 30, function () use ($q, $locale, $altLocale) {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';

            $L = [
                'doctor'  => __('ui.search.tag.doctor'),
                'service' => __('ui.search.tag.service'),
                'article' => __('ui.search.tag.article'),
                'price'   => __('ui.search.tag.price'),
            ];

            $out  = collect();
            $push = function(array $item) use ($out) { $out->push($item); };

            /* ВРАЧИ */
            if ($this->tableExistsCached('doctors')) {
                $dc = $this->columnsCached('doctors');
                $tt = null;
                foreach (['doctor_translations','doctors_translations'] as $t) {
                    if ($this->tableExistsCached($t)) { $tt = $t; break; }
                }
                if ($tt) {
                    $tc = $this->columnsCached($tt);
                    $nameCols = array_values(array_intersect($tc, ['name','title','full_name']));
                    $posCols  = array_values(array_intersect($tc, ['position','profession','specialty']));
                    $slugCols = array_values(array_intersect($tc, ['slug']));
                    $localeCol= in_array('locale',$tc,true) ? 'locale' : (in_array('lang',$tc,true) ? 'lang' : null);

                    $q1 = DB::table("$tt as tt")->join('doctors as d','d.id','=','tt.doctor_id');
                    if ($localeCol) {
                        $q1->where(function($qq) use ($localeCol,$locale,$altLocale){
                            $qq->where("tt.$localeCol",$locale);
                            if ($altLocale !== $locale) $qq->orWhere("tt.$localeCol",$altLocale);
                        });
                    }
                    $q1->where(function($qq) use ($nameCols,$posCols,$like){
                        foreach ($nameCols as $c) $qq->orWhere("tt.$c",'like',$like);
                        foreach ($posCols  as $c) $qq->orWhere("tt.$c",'like',$like);
                    });

                    $select = ['d.id'];
                    $select[] = $nameCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$nameCols)).') as t_name') : DB::raw("'" . $L['doctor'] . "' as t_name");
                    $select[] = $posCols  ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$posCols)).') as t_pos')  : DB::raw('NULL as t_pos');
                    $select[] = $slugCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$slugCols)).') as t_slug') : (in_array('slug',$dc,true) ? 'd.slug as t_slug' : DB::raw('NULL as t_slug'));

                    foreach ($q1->select($select)->limit(5)->get() as $r) {
                        $url = (isset($r->t_slug) && $r->t_slug && Route::has('doctors.show'))
                            ? route('doctors.show', ['doctor' => $r->t_slug])
                            : (Route::has('doctors.index') ? route('doctors.index', ['q'=>$q]) : url('/'));

                        $push([
                            'title'    => $r->t_name ?: $L['doctor'],
                            'subtitle' => $r->t_pos ?: null,
                            'url'      => $url,
                            'type'     => 'doctor',
                        ]);
                    }
                }
            }

            /* УСЛУГИ / НАПРАВЛЕНИЯ */
            $mainTable = null;
            foreach (['services','directions','categories'] as $t) {
                if ($this->tableExistsCached($t)) { $mainTable = $t; break; }
            }
            if ($mainTable) {
                $tt = null;
                foreach (["{$mainTable}_translations",'service_translations','services_translations','direction_translations','directions_translations','category_translations','categories_translations'] as $t) {
                    if ($this->tableExistsCached($t)) { $tt = $t; break; }
                }
                if ($tt) {
                    $tc = $this->columnsCached($tt);
                    $mc = $this->columnsCached($mainTable);
                    $localeCol = in_array('locale',$tc,true) ? 'locale' : (in_array('lang',$tc,true) ? 'lang' : null);

                    $fk = null;
                    foreach ($tc as $c) {
                        if (Str::endsWith($c,'_id')) {
                            if ($c === Str::singular($mainTable).'_id' || in_array($c, ['service_id','direction_id','category_id'])) { $fk = $c; break; }
                        }
                    }
                    if ($fk) {
                        $nameCols = array_values(array_intersect($tc, ['name','title']));
                        $slugCols = array_values(array_intersect($tc, ['slug']));
                        $pathT    = in_array('full_path',$tc,true) ? 'full_path' : null;
                        $pathM    = in_array('full_path',$mc,true) ? 'full_path' : null;

                        $q2 = DB::table("$tt as tt")->join("$mainTable as m","m.id","=","tt.$fk");
                        if ($localeCol) {
                            $q2->where(function($qq) use ($localeCol,$locale,$altLocale){
                                $qq->where("tt.$localeCol",$locale);
                                if ($altLocale !== $locale) $qq->orWhere("tt.$localeCol",$altLocale);
                            });
                        }
                        $q2->where(function($qq) use ($nameCols,$like){
                            foreach ($nameCols as $c) $qq->orWhere("tt.$c",'like',$like);
                        });

                        $select = ['m.id'];
                        $select[] = $nameCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$nameCols)).') as t_name') : DB::raw("'" . $L['service'] . "' as t_name");
                        if ($slugCols) $select[] = DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$slugCols)).') as t_slug');
                        if ($pathT) $select[] = "tt.$pathT as t_path";
                        if (!$pathT && $pathM) $select[] = "m.$pathM as t_path_m";

                        foreach ($q2->select($select)->limit(5)->get() as $r) {
                            $url = $r->t_path ?? $r->t_path_m ?? null;
                            if (!$url) {
                                $slug = $r->t_slug ?? null;
                                if ($slug) {
                                    if (Route::has('directions.show')) $url = route('directions.show',['slug'=>$slug]);
                                    elseif (Route::has('services.show')) $url = route('services.show',['slug'=>$slug]);
                                }
                            }
                            if (!$url) {
                                $url = Route::has('directions.page') ? route('directions.page')
                                     : (Route::has('services.index') ? route('services.index') : url('/'));
                            }

                            $push([
                                'title'    => $r->t_name ?: $L['service'],
                                'subtitle' => null,
                                'url'      => $url,
                                'type'     => 'service',
                            ]);
                        }
                    }
                }
            }

            /* СТАТЬИ */
            $articleTable = null;
            foreach (['articles','posts','blog_posts'] as $t) {
                if ($this->tableExistsCached($t)) { $articleTable = $t; break; }
            }
            if ($articleTable) {
                $tt = null;
                foreach (["{$articleTable}_translations",'article_translations','articles_translations','post_translations','posts_translations'] as $t) {
                    if ($this->tableExistsCached($t)) { $tt = $t; break; }
                }
                if ($tt) {
                    $tc = $this->columnsCached($tt);
                    $mc = $this->columnsCached($articleTable);
                    $localeCol = in_array('locale',$tc,true) ? 'locale' : (in_array('lang',$tc,true) ? 'lang' : null);
                    $fk = null;
                    foreach ($tc as $c) {
                        if (Str::endsWith($c,'_id')) {
                            if ($c === Str::singular($articleTable).'_id' || in_array($c,['article_id','post_id'])) { $fk = $c; break; }
                        }
                    }
                    $titleCols = array_values(array_intersect($tc, ['title','name']));
                    $slugCols  = array_values(array_intersect($tc, ['slug']));
                    $pubCol    = in_array('published',$mc,true) ? 'published' : (in_array('is_published',$mc,true) ? 'is_published' : null);

                    if ($fk) {
                        $q3 = DB::table("$tt as tt")->join("$articleTable as a","a.id","=","tt.$fk");
                        if ($localeCol) {
                            $q3->where(function($qq) use ($localeCol,$locale,$altLocale){
                                $qq->where("tt.$localeCol",$locale);
                                if ($altLocale !== $locale) $qq->orWhere("tt.$localeCol",$altLocale);
                            });
                        }
                        if ($pubCol) $q3->where("a.$pubCol", 1);

                        $q3->where(function($qq) use ($titleCols,$like){
                            foreach ($titleCols as $c) $qq->orWhere("tt.$c",'like',$like);
                        });

                        $select = ['a.id'];
                        $select[] = $titleCols ? DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$titleCols)).') as t_title') : DB::raw("'" . $L['article'] . "' as t_title");
                        if ($slugCols) $select[] = DB::raw('COALESCE('.implode(',', array_map(fn($c)=>"tt.$c",$slugCols)).') as t_slug');
                        if (in_array('slug',$mc,true)) $select[] = "a.slug as t_slug_m";

                        foreach ($q3->select($select)->limit(5)->get() as $r) {
                            $slug = $r->t_slug ?? $r->t_slug_m ?? null;
                            $url  = $slug && Route::has('articles.show') ? route('articles.show',['slug'=>$slug])
                                  : (Route::has('articles.index') ? route('articles.index',['q'=>$q]) : url('/'));

                            $push([
                                'title'    => $r->t_title ?: $L['article'],
                                'subtitle' => null,
                                'url'      => $url,
                                'type'     => 'article',
                            ]);
                        }
                    }
                }
            }

            /* ПРАЙС (подсказки): сперва сервис, затем фолбэк */
            $base = Route::has('prices.page') ? route('prices.page') : url('/prices');

            $rows = $this->fetchPricesViaService(request(), $locale, $q);
            if (!$rows) $rows = $this->fetchPricesViaEloquent($locale, $q);

            if ($rows) {
                $i=0;
                foreach ($rows as $r) {
                    $push([
                        'title'    => $r['title'],
                        'subtitle' => isset($r['price']) ? $this->fmtUAH($r['price']) : null,
                        'url'      => $this->buildUrl($base, ['q' => $r['title']]),
                        'type'     => 'price',
                    ]);
                    if (++$i >= 5) break;
                }
            } else {
                try {
                    $json = $this->dispatchAjax('POST','/prices-search-filter',[
                        'query' => ['search' => $q],
                        'limit' => 5,
                        'lang'  => $locale,
                    ], request());
                    if (is_array($json)) {
                        $rows = $this->pluckRowsFromPayload($json);
                        $i=0;
                        foreach ($rows as $r) {
                            $title = $r["title_$locale"] ?? $r["name_$locale"] ?? $r['title'] ?? $r['name'] ?? $r['service'] ?? $L['price'];
                            $price = $r['price'] ?? $r['amount'] ?? $r['value'] ?? null;

                            $push([
                                'title'    => $title,
                                'subtitle' => isset($price) ? $this->fmtUAH($price) : null,
                                'url'      => $this->buildUrl($base, ['q' => $title]),
                                'type'     => 'price',
                            ]);
                            if (++$i>=5) break;
                        }
                    }
                } catch (\Throwable $e) {}
            }

            return $out->values();
        });

        return response()->json($out);
    }
}
