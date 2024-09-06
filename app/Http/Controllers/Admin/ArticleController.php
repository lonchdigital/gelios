<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
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
}
