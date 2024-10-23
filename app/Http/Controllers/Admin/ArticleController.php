<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.article.index');
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
        return view('admin.article.slider.create', compact('page'));
    }

    public function editSlide(Page $page, PageBlock $block)
    {
        return view('admin.article.slider.edit', compact('page', 'block'));
    }
}
