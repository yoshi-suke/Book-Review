<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['isbn','name', 'author', 'score', 'comment'];

    public function user() {
      return $this->belongsTo('App\User');
    }

    // public function getRouteKeyName() {
    //   return 'isbn';
    // }
}
