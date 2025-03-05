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
    public function index(Request $request, $page = 1)
    {
        $articles = Article::paginate(9, ['*'], 'page', $page);

        $categories = ArticleCategory::get();

        $page = Page::where('type', PageType::BLOG->value)
            ->with('translations')
            ->first();

        return view('site.articles.index', compact('articles', 'categories', 'page'));
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

        $seo = $service->getMeta($page->title, $articlePage->meta_title, $articlePage->meta_description);
        $seo[1] = strip_tags($seo[1]);

        if ($article) {
            $relatedArticles = Article::where('id', '!=', $article->id)
                ->inrandomOrder()
                ->take(3)
                ->get();

            return view('site.articles.show', compact('article', 'articlePage', 'relatedArticles', 'seo'));
        } else {

            if( $slug === 'dogovor-oferty' ) {
                abort(404);
            }

            $page = Page::where('slug', $slug)->first();

            if(empty($page->type) || $page->type !== "text" ) { abort(404); }

            return view('site.text-pages.show', [
                'page' => $page
            ]);
        }

    }
}
