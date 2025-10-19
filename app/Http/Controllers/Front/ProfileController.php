<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Utis\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PostRequest;

class ProfileController extends Controller
{
    public function show()
    {
         $posts = auth()->user()->posts;
        return view('front.dashboard.profile',compact('posts'));
    }

    public function getPostForm(PostRequest $request)
    {
        $request->validated();
 try {
            DB::beginTransaction();


        $request->comment_able == "on"? $request->merge(['comment_able'=>1]):$request->merge(['comment_able'=>0]);

        $post = auth()->user()->posts()->create($request->except('images'));
        ImageManager::uploadImages($request,$post);

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        return redirect()->back()->with('success', 'POST created Successfuly!');


    }


    public function postEdit($slug)
    {
        $post = Post::whereSlug($slug)->first();
        return view('front.dashboard.edit',compact('post'));
    }

    public function updatePost(PostRequest $request)
    {
        return $request;
    }
}
