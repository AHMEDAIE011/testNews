<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }
    public function store(ContactRequest $request )
    {
        $request->validated();

        $request->merge([
            'ip_address' => $request->ip(),
        ]);

        $contact = Contact::create($request->except('_tok1n'));

        if (!$contact) {
            Session::flash('error','contact error');
            return redirect()->back();
        }
        
            Session::flash('success','contact successfuly');
            return redirect()->back();
    }
}
