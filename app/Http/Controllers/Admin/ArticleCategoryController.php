<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        return view('admin.article-category.index');
    }

    public function create()
    {
        return view('admin.article-category.create');
    }

    public function edit(ArticleCategory $category)
    {
        return view('admin.article-category.edit', compact('category'));
    }
}
