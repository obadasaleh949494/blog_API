<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'title' => 'required|string',
            'body' => 'required|string',
//            'img_url' => 'file'
        ]);
//        return $request['img_url'];
        if ($validator->fails())
            return $validator->messages();

        $post = new Post;


        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $post->img_url = $name;
        }
        $post->title = $request['title'];
        $post->user_id = \Auth::id();
        $post->body = $request['body'];
        $post->save();
        return response()->json($post);

    }


    public function getPost($id)
    {

        $post = Post::find($id);

        return ['post' => $post->with(['comments' => function ($sql) {
            return $sql->with('user');
        }])->where('id', $id)->first(), 'user' => User::find($post->user_id)];

    }

    public function index()
    {

        return Post::with('user')->get();
    }


    public function  editPost(Request $request , $postId){


            $post = Post::find($postId);

            $post->update([
                'title' => $request['title'],
                'body' => $request['body']
            ]);
            return $post;

    }

    public function deletePost($postId)
    {
        $post = Post::where('id' , $postId)->first();
        return response()->json($post->delete());
    }

}
