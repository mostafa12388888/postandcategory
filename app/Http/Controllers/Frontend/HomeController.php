<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $posts=Post::with('images')->select('id','title','slug')->latest()->paginate(9);
        $grate_of_views=Post::with('images')->select('id','title','slug')->orderBy('number_of_views','desc')->limit(3)->get();
        $oldestNews=Post::with('images')->select('id','title','slug')->oldest()->take(3)->get();
         $gratePostComments=Post::with('images')->select('id','title','slug')->withCount('comments')->orderBy('comments_count','desc')->take(3)->get();
        $categories = Category::all();
        $categoryWithPost=$categories->map(function($category){
                $category->posts = $category->posts()->limit(5)->get();
                return $category;
            }
        );
        return view('frontend.index',compact('posts','grate_of_views','oldestNews','gratePostComments','categories','categoryWithPost'));
    }
}
