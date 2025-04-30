<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function addPost(request $req){
        $user=Auth::guard('api')->user();
        if(!$user){
            $result['status']='failed';
            $result['message']='Unauthorized';
            return $result;
        }
        $validated=$req->validate([
            'title'=>'required',
            'description'=>'required|max:255'
        ]);
        $post=new post;
        $post->title=$validated['title'];
        $post->description=$validated['description'];
        $post->user_id=$user->id;
        $post-save();

        $result['status']='success';
        $result['message']='post created';
        return $result;
    }
}
