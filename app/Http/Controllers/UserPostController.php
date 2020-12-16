<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Like;
use App\Models\User;
use App\Models\Post;;

class UserPostController extends Controller
{
    public function index($id){
        $user = User::all()->find($id);
        $posts = Post::latest()->where('user_id' , $id)->paginate(2);
       return view('layouts.userPosts' ,[
           'user' => $user ,
           'posts' => $posts
       ]);
    }
}