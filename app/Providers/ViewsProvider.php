<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class ViewsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $read_more_posts = Post::latest()->limit(12)->get();
        $categories = Category::all();
        view()->share([
            'read_more_posts'=>$read_more_posts,
            'categories'=>$categories,

        ]);
    }
}
