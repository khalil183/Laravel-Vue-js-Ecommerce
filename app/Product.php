<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name','slug','code','image','qty','brand_id','category_id','buying_price','selling_price','status'
    ];
}