<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request, $postId)
    {
        $request['user_id'] = \Auth::id();
        $request['post_id'] = $postId;
        $comment =  Comment::create(['content' => $request['content'] , 'user_id' => \Auth::id() , 'post_id' => $postId]);

        $comment['name'] = User::find($comment->user_id)->name;
        return $comment->where('id' , $comment->id)->with('user')->first();

    }


    public function index($post){
        return Comment::where('post_id' , $post)->with('user')->get();
    }

}
