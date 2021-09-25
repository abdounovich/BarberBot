<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AvatarController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

public function update(Request $request){

    $user=User::find(Auth::user()->id);
        $name=$request->get("name");
    $email=$request->get("email");
    $password=$request->get("password");
    $password2=$request->get("password2");

    $avatar=$request->get("avatar");

    if ($password==$password2) {
       $user->update([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'avatar' => $avatar,

    ]);


   
    return back()->with("success"," لقد تم حفظ البيانات بنجاح");
    }
    else{
        return back()->with("erreur"," كلمة المرور غير متطابقة ");

    }

   
}
}
