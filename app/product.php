<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['supplierID','category','product_name','product_price','product_qty','product_image','product_details'];
}
