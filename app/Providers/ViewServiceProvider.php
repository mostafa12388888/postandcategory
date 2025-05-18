<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        if(!Cache::has('latestPost')){
            $latestPost=Post::select('id','title','slug')->latest()->limit(5)->get();
            Cache::remember('latestPost', 3650, function() use($latestPost)  {
                return $latestPost;
            });
        }

        if(!Cache::has('gratePostComments')){
            $gratePostComments=Post::with('images')->select('id','title','slug')->withCount('comments')->orderBy('comments_count','desc')->take(5)->get();
            Cache::remember('gratePostComments', 3650, function() use($gratePostComments)  {
                return $gratePostComments;
            });
        }
        $latestPost=Cache::get('latestPost');
        $gratePostComments=Cache::get('gratePostComments');
        $categories=Category::with('posts')->select('id','name','slug')->get();
        view()->share([
            'latestPost'=>$latestPost,
            'gratePostComments'=>$gratePostComments,
            'categories'=>$categories
        ]);
    }
}
