<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {          
        $request->validate([           
            'comment' => 'required',           
        ]);
       
        $comment = Comment::create([
           
            'body' => $request->comment, 
            'commentable_type' => $request->model,
            'commentable_id' => $request->model_id,          
        ]);
        if($request->model == "App\Models\Post")
        {
            return redirect()->route('posts');


        }else{
            return redirect()->route('videos');

        }

    }
}
