<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user(){
        return $this->belongsToMany(Tag::class);
    }
    public function tags (){
        return $this->belongsToMany(Tag::class);
    }
}
