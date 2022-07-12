<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {   
        $all_categories = $this->category->all();

        return view('posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|max:30',
            'category' => 'required',
            'description' => 'required|min:1|max:500',
            'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        $this->post->user_id = Auth::user()->id;
        $this->post->category_id = $request->category;
        $this->post->title = $request->title;
        $this->post->description = $request->description;
        
        if(empty($request->image)){
            $this->post->image = null;
        }else{
            $this->post->image = $this->saveImage($request);
        }

        $this->post->save();

        return redirect()->route('home');
    }

    private function saveImage($request)
    {
        $image_name = time() . "." . $request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        if($post->user_id !== Auth::user()->id){
            return redirect()->route('home');
        }

        $all_categories = $this->category->all();
        $selected_category = $post->category_id;

        return view('posts.edit')
                    ->with('post', $post)
                    ->with('all_categories', $all_categories)
                    ->with('selected_category', $selected_category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:50',
            'category' => 'required',
            'description' => 'required|min:1|max:500',
            'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        $post = $this->post->findOrFail($id);
        
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->description = $request->description;

        if($request->image){
            $this->deleteImage($post->image);

            $post->image = $this->saveImage($request);
        }

        $post->save();

        return redirect()->route('post.show', $id);
    }

    public function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function delete($id)
    {   
        $post = $this->post->findOrFail($id);

        $this->deleteImage($post->image);
        $post->destroy($post->id);

        return redirect()->route('home');
    }
}
