<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.myprofile',['user'=>$user]);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        $user->save();
      //  return redirect()->back()->with('status','Profile updated successfully!!!');
        return redirect()->route('profile.index')->with('success','Profile has been updated!!!');

    }

    public function show($id)
    {
        $user = User::find($id);
        return view('pages.profile',['user'=>$user]);
    }



}
