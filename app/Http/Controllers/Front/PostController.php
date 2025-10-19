<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        //post with 5 comments and images
        $mainPost = Post::whereSlug($slug)->with(['comments'=>function($comment){
            $comment = $comment->latest()->take(3);
            return $comment;
        }])->with('images')->first();

        //category_belongsTo_posts
        $category = $mainPost->category;
        $category_belongsTo_posts =  $category->posts()->latest()->take(5)->get();
        
        //latest 5 posts 
        $latest_posts = Post::latest()->take(5)->get();

        //latest 5 posts and Bag num off comment
        $gretest_posts_comments = Post::withCount('comments')->orderBy('comments_count','desc')->take(5)->get();
        
        return view('front.showPost',compact(
            'mainPost',
            'category_belongsTo_posts',
            'latest_posts',
            'gretest_posts_comments',
        ));
         
    }

    public function getAllComments($slug)
    {
        $post = Post::whereSlug($slug)->first();
        $comment = $post->comments()->with('user')->latest()->get();
        return response()->json($comment);
    }


    public function store(Request $request)
    {

        $request->validate([
            "comment"=> ['required','string','max:500'],
        ]);

        $request->merge([
            'ip_address' => $request->ip(),
        ]);

        $comment = Comment::create($request->all());

        
        // بتنفذ ريليشن مع الكوليكشن اللي راجع
        $comment->load('user');


        if (!$comment) {
            return response()->json([
                'data'=> 'opration failed',
                'status' => '403'
            ]);
        }

        return response()->json([
            'msg' => 'comment stored successfily!',
            'comment' => $comment,
            'status' => '403'
        ]);



    }
}



