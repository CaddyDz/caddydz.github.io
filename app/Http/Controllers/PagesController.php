<?php

namespace Caddy\Http\Controllers;

use Caddy\Meta;
use Caddy\Member;
use Caddy\Article;

class PagesController extends Controller
{

    /**
     * Show the site's index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->take(3)->get();
        return view('index', compact('articles'));
    }

    /**
     * Hero section data
     *
     * This function is called by vue via axios
     * to retreive data for the Hero component
     *
     * @return Illuminate\Http\Response $response
     **/
    public function getHeroData()
    {
        $heroTitle = optional(Meta::whereName('heroTitle')->first())->content;
        $heroContent = optional(Meta::whereName('heroContent')->first())->content;
        return response([
            'title' => $heroTitle,
            'content' => $heroContent,
        ]);
    }

    /**
     * Get Navigation Component Data
     *
     * This function returns a json response
     * to be fetched by axios in vue client
     *
     * @return Illuminate\Http\Response
     **/
    public function getNavData()
    {
        return response([
            'app' => [
                'name' => config('app.name'),
            ]
        ]);
    }

    /**
     * Return about page.
     *
     * Supply necessary data to about view
     *
     * @return View
     **/
    public function about()
    {
        $members = Member::all();
        return view('about', compact('members'));
    }
}
