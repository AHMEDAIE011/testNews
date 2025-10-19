<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);
        $oldest_posts = Post::with('images')->oldest()->limit(3)->get();
        $gretest_posts_comments = Post::withCount('comments')->orderBy('comments_count','desc')->limit(3)->get();
        $gretest_posts_views = Post::orderBy('num_of_views','desc')->limit(3)->get();

        $categories = Category::has('posts','>=',2)->get();
        $categories_with_posts = $categories->map(function($category){
            $category->posts =  $category->posts()->latest()->limit(3)->get();
            return $category;
        });

        return view('front.index',compact(
            'posts',
        'oldest_posts',
        'gretest_posts_comments',
        'gretest_posts_views',
        'categories_with_posts',
        
        ));
    }
}
