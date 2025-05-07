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
        $post->save();

        $result['status']='success';
        $result['message']='post created';
        return $result;
    }
    public function GetMyPost(Request $req){
        $user=Auth::guard('api')->user();
        if(!$user){
            $result['status']='post oruulagvi bna';
            $result['message']='bhgvv bna';
            return $result;
        }
        $post=Post::where('user_id','=',$user->id)->get();
        $result['status']='success';
        $result['data']=$post;
        return $result;
    }
    public function Uppost(Request $req){
        $user=Auth::guard('api')->user();
        if(!$user){
            $result['status']='oldsongvi';
            $result['message']='bhgvi bna';
            return $result;
        }
        $foundPost=Post::find($req->postId);
        if($foundPost){
            $result['status']='oldsongvi';
            $result['message']='post not found';
            return $result;
        }
        $foundPost->update([
            'title'=>$req->title,
            'description'=>$req->description,
        ]);
        $result['status']='success';
        $result['data']=$foundpost;
        return $foundPost;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
    }
}
