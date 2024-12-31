<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Products extends Model
{
    use Sluggable;

   public function sluggable():array{
    return [
        "slug"=> [
            'source'=> 'title',
        ]
        ];
   }
    
}
