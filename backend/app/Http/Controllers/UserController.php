<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUp(Request $req){
        $found=User::where('email','=',$req->email)->first();
        if($found){
            $result['status']='failed';
            $result['message']='email already exists';
            return $result;
        }else{
            $validated=$req->validate([
                'name'=>'required',
                'email'=>'required|email',
                'password'=>'required|min:3',
                'phone'=>'required|max:8',
                'address'=>'required'
            ]);
            $user=new User;
            $user->name=$validated["name"];
            $user->email=$validated["email"];
            $user->password=Hash::make($validated["password"]);
            $user->phone=$validated["phone"];
            $user->address=$validated["address"];
            $user->save();
            $result['status']='success';
            $result['message']='account created';
            return $result;
        }
        
    }
    public function login(Request $req){
        $found=User::where('email','=',$req->email)->first();
        if(!$found){
            $result['status']='failed';
            $result['message']='account not found';
            return $result;
        }else{
            if(Hash::check($req->password,$found->password)){
                $token=$found->createToken($found->email);
                $result['status']='succes';
                $result['token']=$token->plainTextToken;
                return $result;
            }else{
                $result['status']='failed';
                $result['status']='email or password in correct';
                return $result;
            }
        }
    }
    
    
}