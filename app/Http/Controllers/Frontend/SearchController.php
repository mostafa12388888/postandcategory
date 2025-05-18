<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:150',
        ]);
        $search = strip_tags($request->search);
        $posts = Post::where('title', 'LIKE', '%' . $search . '%')->orWhere('desc', 'LIKE', '%' . $search . '%')->paginate(14);
        return view('frontEnd.search', compact('posts'));
    }
}
