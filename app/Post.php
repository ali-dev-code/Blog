<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

  protected $dates = [

    'published_at'

  ];

   protected $fillable = [

     'title', 'description', 'content', 'image', 'published_at', 'category_id','user_id' // ye waly yoh db me name hen
   ];

// delte post image from storage

   public function deleteImage(){


    Storage::delete($this->image);
   }

   public function category() {

     return $this->belongsTo(Category::class); // ye relation hai categry k sath make sure category small me.

   }


   public function tags(){

    return $this->belongsToMany(Tag::class);

   }

/// chech if posts ha a tag

   public function hasTag($tagId){

    return in_array($tagId, $this->tags->pluck('id')->toArray());

   }

   public function user(){

    return $this->belongsTo(User::class);

   }


   // for postpublished

    public function scopePublished($query){

    return $query->where('published_at', '<=', now() );

    }


   // function for Query scope = Qiery builder

  public function scopeSearched($query) // this is convention method
  {

   $search = request()->query('search');

   if (!$search) {

    return $query->published();

   }

   return $query->published()->where('title', 'LIKE', "%{$search}%");

  }


}
