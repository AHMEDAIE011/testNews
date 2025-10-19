<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory($slug)
    {
        $category = Category::whereSlug($slug)->with('posts')->first();
        $posts = $category->posts()->latest()->paginate(9);
        return view('front.category',compact('posts'));
        
    }
   public function getAllCategories()

   {
    $allCategories = Category::with('posts')->get();
  
        return view('front.getAllCategories',compact('allCategories'));
    
   }
   public function getCategoryPosts(Request $request, $categoryId)
{
    $category = Category::findOrFail($categoryId);

    $pageName = 'page_' . $categoryId;
    $page = $request->query($pageName, 1);

    $posts = $category->posts()
        ->latest()
        ->paginate(3, ['*'], $pageName, $page);

    return view('front.partials.category_posts', compact('posts', 'category'));
}

}



