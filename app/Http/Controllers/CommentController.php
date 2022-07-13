<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{   
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store($id, Request $request)
    {
        $request->validate([
            'comment_body' => 'required|max:100'
        ]);
        
        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $id;
        $this->comment->body = $request->comment_body;

        $this->comment->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
