<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class PostLikeController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function store(Post $post , Request $request){
        $post->likes()->create([
            'user_id' => $request->user()->id ,
        ]);

        return back();
    }

    public function destroy(Post $post , Request $request){
        $request->user()->likes()->where('post_id' , $post->id)->delete();

        return back();
    }
}