<?php

namespace App\Http\Controllers;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Services\Site\MetaService;

class ArticleController extends Controller
{
    // public function index(Request $request, $page = 1)
    // {
    //     $articles = Article::paginate(9, ['*'], 'page', $page);

    //     $categories = ArticleCategory::get();

    //     $page = Page::where('type', PageType::BLOG->value)
    //         ->with('translations')
    //         ->first();

    //     $url['ua'] = url('/') . '/ua/dlya-paczientov';
    //     $url['ru'] = url('/') . '/dlya-paczientov';
    //     $url['en'] = url('/') . '/en/dlya-paczientov';

    //     return view('site.articles.index', compact('articles', 'categories', 'page', 'url'));
    // }

    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        $articles = Article::when($categoryId, function ($query) use ($categoryId) {
            return $query->where('article_category_id', $categoryId);
        })->get();

        $categories = ArticleCategory::all();

        $page = Page::where('type', PageType::BLOG->value)
            ->with('translations')
            ->first();

        $url['ua'] = url('/') . '/ua/dlya-paczientov';
        $url['ru'] = url('/') . '/dlya-paczientov';
        $url['en'] = url('/') . '/en/dlya-paczientov';

        if ($request->ajax()) {
            return response()->json([
                'articles' => view('site.articles.list', compact('articles'))->render(),
            ]);
        }

        return view('site.articles.index', compact('articles', 'categories', 'page', 'url'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();

        $page = Page::where('type', PageType::ARTICLE->value)
            ->with('translations')
            ->first();

        $service = resolve(MetaService::class);

        $articlePage = Page::where('type', PageType::ARTICLE->value)
            ->with('translations')
            ->first();

        $seo = $service->getMeta($article->title ?? '', trans('web.blog_seo_title'), trans('web.blog_seo_description'));
        $seo[1] = strip_tags($seo[1]);

        $url['ua'] = url('/') . '/ua/dlya-paczientov/' . $slug;
        $url['ru'] = url('/') . '/dlya-paczientov/' . $slug;
        $url['en'] = url('/') . '/en/dlya-paczientov/' . $slug;

        if ($article) {
            $relatedArticles = Article::where('id', '!=', $article->id)
                ->inrandomOrder()
                ->take(3)
                ->get();

            return view('site.articles.show', compact('article', 'articlePage', 'relatedArticles', 'seo', 'url'));
        } else {

            if( $slug === 'dogovor-oferty' ) {
                abort(404);
            }

            $page = Page::where('slug', $slug)->first();

            if(empty($page->type) || $page->type !== "text" ) { abort(404); }

            return view('site.text-pages.show', [
                'page' => $page,
                'url' => $url
            ]);
        }

    }
}
