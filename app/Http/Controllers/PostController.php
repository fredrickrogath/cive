<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts=Post::latest()->with(['user' , 'likes'])->paginate(2);
        return view('layouts.post' , [
          'posts' => $posts
        ]);
    }

    public function store(Request $request){
        
        $this->validate($request ,[
            'body'=>'required',
        ]);
        
        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post){
        $post->delete();

        return back();
    }
}
