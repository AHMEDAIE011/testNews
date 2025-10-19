<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'search' => ['nullable','string','max:200']
        ]);
        $keyboard = strip_tags($request->search);
        $posts = Post::where('title','LIKE','%'.$keyboard.'%')
        ->orWhere('desc','LIKE','%'.$keyboard.'%')
        ->paginate(12);

        return view('front.search',compact('posts'));
        
    }
}
