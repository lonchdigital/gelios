<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(9);

        $categories = ArticleCategory::get();

        return view('site.articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->inrandomOrder()
            ->take(3)
            ->get();

        return view('site.articles.show', compact('article', 'relatedArticles'));
    }
}
