<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageType;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleSlider;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.article.index');
    }

    public function index2()
    {
        return view('admin.article.index2');
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function edit(Article $article)
    {
        return view('admin.article.edit', compact('article'));
    }

    public function createBlock(Article $article)
    {
        return view('admin.article.block.create', compact('article'));
    }

    public function editBlock(Article $article, ArticleBlock $block)
    {
        return view('admin.article.block.edit', compact('article', 'block'));
    }

    public function createSlide(Page $page)
    {
        return view('admin.article.create-slider', compact('page'));
    }

    public function editSlide(Page $page, PageBlock $block)
    {
        return view('admin.article.edit-slider', compact('page', 'block'));
    }

    public function editBlogBlock(PageBlock $block)
    {
        return view('admin.article.edit-block', compact('block'));
    }

    public function mainPageSeo()
    {
        $page = Page::where('type', PageType::BLOG->value)
            ->first();

        return view('admin.article.main-page-seo', compact('page'));
    }

    public function onePageSeo()
    {
        $page = Page::where('type', PageType::ARTICLE->value)
            ->first();

        return view('admin.article.one-page-seo', compact('page'));
    }

    public function createArticleSlide(Article $article)
    {
        return view('admin.article.slider.create', compact('article'));
    }

    public function editArticleSlide(Article $article, ArticleSlider $slide)
    {
        return view('admin.article.slider.edit', compact('article', 'slide'));
    }
}
