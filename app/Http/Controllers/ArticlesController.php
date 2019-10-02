<?php

namespace Caddy\Http\Controllers;

use Caddy\User;
use Caddy\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('by')) {
            $articles = User::whereName($request->by)->first()->articles()->paginate(3);
            return view('blog.articles', compact('articles'));
        }
        $articles = Article::latest()->paginate(3);
        return view('blog.articles', compact('articles'));
    }

    /**
     * Display the specified article.
     *
     * @param Caddy\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('blog.article', compact('article'));
    }
}
