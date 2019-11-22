@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-end mb-2">
    <a class="btn btn-success float-right" href="{{ route('posts.create') }}">Add Posts</a>
</div>

<div class="card card-default">
  <div class="card-header">
    {{ isset($posts) ? 'Edit Post' : 'Create Post'  }}
  </div>
  <div class="card-body">
      @include('partials.errors')
   <form  action="{{ isset($posts) ? route('posts.update', $posts->id) : route('posts.store') }}" method="post" enctype="multipart/form-data" >
     @csrf

     @if (isset($posts))
       @method('PUT')
     @endif

     <div class="form-group">
       <label for = "title" >Title</label>
       <input class="form-control" id="title" type="text" name="title" value="{{ isset($posts) ? $posts->title : '' }}">
     </div>

     <div class="form-group">
       <label for = "description" >Description</label>
       <textarea class="form-control" name="description" id="description" rows="5" cols="5">{{ isset($posts) ? $posts->description : '' }}</textarea>

     </div>
     <div class="form-group">
       <label for = "content" >Content</label>

       <input id="content"  type="hidden" name="content" value="{{ isset($posts) ? $posts->content : '' }}" >
       <trix-editor input="content"></trix-editor>

     </div>

     <div class="form-group">
       <label for = "published_at" >Published At</label>
       <input class="form-control" id="published_at" type="text" name="published_at" value="{{ isset($posts) ? $posts->published_at : '' }}">
     </div>

     @if (isset($posts))
       <div class="form-group">
         <img src="{{ asset("/storage/$posts->image") }}" width="100px" height="60px" alt="">
       </div>
     @endif



     <div class="form-group">

         <div class="custom-file">
           <input type="file" class="custom-file-input" name="image" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
         </div>
     </div>

     <div class="form-group">
       <label for="category">Category</label>
       <select class="form-control" id="category" name="category">

         @foreach ($categories as $category)
           <option value="{{ $category->id }}"

        @if (isset($posts))

          @if ($category->id === $posts->category_id)
            selected
          @endif

        @endif

             >
            {{ $category->name }}

          </option>
         @endforeach
       </select>
     </div>


     <div class="form-group">
       <label for="tags">Tags</label>
       @if ($tags->count() > 0)

         <select class="form-control js-example-basic-single" name="tags[]" id="tags" multiple >

          @foreach ($tags as $tag)

             <option value="{{ $tag->id }}"

          @if (isset($posts))
          @if ($posts->hasTag($tag->id))
             selected
          @endif
          @endif
               >

                {{ $tag->name }}

             </option>

          @endforeach

         </select>

       @endif
     </div>


     <div class="form-group">
       <button  class="btn btn-success float-right" type="submit" name="button">

          {{ isset($posts)? 'Update Post' : 'Add Post' }}

       </button>
     </div>



   </form>
  </div>
</div>

@endsection

@section('script')

 <script  src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js" ></script>
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js" >  </script>

 <script type="text/javascript">
   flatpickr('#published_at', {

     enableTime : true,
     enableSeconds : true
   });

   $(document).ready(function() {
       $('.js-example-basic-single').select2();
   });


 </script>

@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">

@endsection
