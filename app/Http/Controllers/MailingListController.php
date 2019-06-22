<?php

namespace Caddy\Http\Controllers;

use Newsletter;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    public function subscribe(Request $request)
    {
        Newsletter::subscribe($request->email);
        return back();
    }
}
