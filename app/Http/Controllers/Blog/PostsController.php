<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

use App\Category;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }


    public function category(Category $category)
    {

  //  return view('blog.category')->with('category', $category)->with('posts', $category->posts);


          //  $posts = $category->posts()->where('title', 'LIKE', "%{$search}%")->simplePaginate(3) ;

         //    $posts = $category->posts()->simplePaginate(3);


        return view('blog.category')
     ->with('category', $category)
      ->with('posts', $category->posts()->searched()->simplePaginate(2))
     //->with('posts', $category->posts()->simplePaginate(3))
     ->with('categories', Category::all()) // ku side bar me hum ne display krni hai
     ->with('tags', Tag::all()); // ye b isi liy
    }


    public function tag(Tag $tag)
    {
        return view('blog.tag')
    ->with('tag', $tag)
    ->with('posts', $tag->posts()->searched()->simplePaginate(3))
    ->with('categories', Category::all())
    ->with('tags', Tag::all());
    }
}
