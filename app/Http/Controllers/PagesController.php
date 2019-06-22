<?php

namespace Caddy\Http\Controllers;

use Caddy\Meta;
use Caddy\Post;
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
        $meta = Meta::where('name', 'hero')->first();
        $testimonies = Testimony::latest()->take(10)->get();
        $articles = Post::latest()->take(3)->get();
        return view('index', compact('meta', 'clients', 'projects', 'testimonies', 'articles'));
    }
}
