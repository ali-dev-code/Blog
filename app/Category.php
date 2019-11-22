<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =  ['name'] ;


    public function posts(){ // make sure posts s k sath


       return $this->hasMany(Post::class);

    }
}
