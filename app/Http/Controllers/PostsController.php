<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Category;
use App\Tag;

//use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{

   public function __construct(){

    $this->middleware('VerifyCategoriesCount')->only(['create', 'store']); // sirf in pr aply krna hai

   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all()); // ooper path den
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store('posts');

     $post  =      Post::create([

     'title'=> $request->title,
     'description'=> $request->description,
     'content'=> $request->content,
     'image'=> $image,
     'published_at'=> $request->published_at,
     'category_id'=> $request->category,
     'user_id'=> auth()->user()->id

     ]);


     if ($request->tags) {
       $post->tags()->attach($request->tags); // ider ye tags function jo hm ne post model m bnaya hai
     }

        session()->flash('success', 'Post has been added succesfully');
        return redirect(route('posts.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('posts', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // check new image
        // if uploaded then delete old one
        $data = $request->only(['title', 'description', 'published_at', 'content'  ]);

        if ($request->hasFile('image')) {
            // check new image
            // if uploaded
            $image =  $request->image->store('posts');
            //then delete old one
            //  Storage::delete($post->image);
            $post->deleteImage();

            $data['image'] = $image;
        }


// chech if user edit tags

  if ($request->tags) {
    $post->tags()->sync($request->tags);
  }


  if ($request->category) {
    $post->category_id = $request->category;
  }

        // update

        $post->update($data);

        session()->flash('success', 'Post has been updated succesfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // yaha pr hum route binding use ni kr skty
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {
            // for deleting pic from storage
            // ooper hm ne use me storage ka link dia hai
            //  Storage::delete($post->image);
            $post->deleteImage();
            $post->forceDelete();
        } else {

            $post->delete();
        }
        session()->flash('success', 'Post has been deleted succesfully');
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
    }

    // ider hum route bindoing use ni kr skty ku hm ne phle dell kr dia hai trashe me
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post has been restored succesfully');
        return redirect()->back();
    }
}
