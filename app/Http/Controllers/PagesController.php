<?php

namespace Caddy\Http\Controllers;

use Caddy\Meta;
use Caddy\Article;
use Caddy\Client;
use Caddy\Project;
use Caddy\Testimony;

class PagesController extends Controller
{

    /**
     * Show the site's index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->take(6)->get();
        $projects = Project::latest()->take(6)->get();
        $testimonies = Testimony::latest()->take(10)->get();
        $articles = Article::latest()->take(3)->get();
        return view('index', compact('clients', 'projects', 'testimonies', 'articles'));
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
        $heroTitle = Meta::whereName('heroTitle')->first()->content;
        $heroContent = Meta::whereName('heroContent')->first()->content;
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
                'name' => config('app.name'),            ]
        ]);
    }
}
