<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $all_posts = $this->post->latest()->paginate(5);
        $all_categories = $this->category->all();

        if($request->search_title){
            $all_posts = $this->post->where('title', 'LIKE', '%'.$request->search_title.'%')->latest()->paginate(5);
        }

        if($request->search_category){
            $all_posts = $this->post->where('category_id', $request->search_category)->latest()->paginate(5);
        }

        return view('home')
                ->with('all_posts', $all_posts)
                ->with('search_title', $request->search_title)
                ->with('all_categories', $all_categories)
                ->with('search_category', $request->search_category);
    }
}
