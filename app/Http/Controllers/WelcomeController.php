<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Tag;
use App\Post;

class WelcomeController extends Controller
{
    public function index(){

//  $search = request()->query('search');

  //  if ($search) {

    //  $posts = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(2);

    //} else {

    //$posts = Post::simplePaginate(2);

    //}

     return view('welcome')->with('categories', Category::all())

      ->with('tags', Tag::all())
      ->with('posts', Post::searched()->simplePaginate(2));
      //->with('posts', $posts);

      //      ->with('posts', Post::simplePaginate(2));


    }
}
