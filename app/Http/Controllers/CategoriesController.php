<?php

namespace Caddy\Http\Controllers;

use Caddy\Category;

class CategoriesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Caddy\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category->articles;
        $articles = $category->articles()->paginate(3);
        return view('blog.category', compact('category', 'articles'));
    }
}
