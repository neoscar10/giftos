<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Products;

class Order extends Model
{
    //
    public function user(){
        return $this->hasOne('App\Models\User',"id","user_id");
    }

    public function product(){
        return $this->hasOne('App\Models\Products',"id","product_id");
    }
}
