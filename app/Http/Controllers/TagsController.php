<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;


use Illuminate\Http\Request;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CreateTagRequest $request)
    {
// hm ne ooper pgle Request ka path dia hai

        //$Tag = new Tag;
        //$caregory->name = $request->name;
        // optional

        Tag::create([

         'name'=> $request->name

        ]);

        session()->flash('success', 'Tag has been added succesfully');
        return  redirect(route('tags.index'));
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
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagsRequest $request, Tag $tag)// Remeber this is route binding
    {
        //$Tag->name = $request->name;
        // this is anoter way for updating (Mass method)
        $tag->update([
          'name'=> $request->name
        ]);

        session()->flash('success', 'Tag has been updated succesfully');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {
          session()->flash('error', 'Tag can not be deleted as it is associated with post');
          return redirect()->back();
        }

        $tag->delete();
        session()->flash('success', 'Tag has been Deleted succesfully');
        return redirect(route('tags.index'));
    }
}
