<?php

namespace Caddy\Http\Controllers;

use Illuminate\Http\Request;
use Caddy\Http\Requests\SendContactEmailRequest;
use Illuminate\Support\Facades\Mail;
use Caddy\Mail\Contact;

class ContactController extends Controller
{
    public function send(SendContactEmailRequest $request)
    {
        try {
            Mail::to('caddydz4@gmail.com')->send(new Contact($request));
        } catch (\Exception $ex) {
            logger()->error($ex->getMessage());
            return back()->withErrors('failed', 'Could not send email, verify your internet connection');
        }
        return back()->with('status', 'Thanks for contacting me, I\'ll get back to you shortly');
    }
}
