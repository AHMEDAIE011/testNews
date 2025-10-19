<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Front\Newsub;
use App\Models\NewSubscriber;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Session;

class NewSubController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required','email','unique:new_subscribers,email'],
        ]);

        $sub = NewSubscriber::create([
            'email' => $request->email,
        ]);

        if (!$sub) {
            Session::flash('error' , 'error email');
            return redirect()->back();
        }
            Mail::to($request->email)->send(New Newsub());
            Session::flash('success' , 'successfuly email');
            return redirect()->back();
    }
}
