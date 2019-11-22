<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateProfileRequest;


class UsersController extends Controller
{
    public function index(){

      return view('users.index')->with('users', User::all()); // uper path den User model ka

    }


    public function makeAdmin(User $user){

      $user->role = 'admin';

      $user->save();

      Session()->flash('success', 'OMG! you just made the user Admin');


      return redirect(route('users.index'));

    }


    public function edit(){

     return view('users.edit')->with('users', auth()->user());

    }


    public function update(UpdateProfileRequest $request){

    $user = auth()->user();

    $user->update([

     'name' => $request->name,
     'about'=> $request->about

    ]);

    Session()->flash('success', 'Profile Updated successfully');
    return redirect()->back();


    }
}
