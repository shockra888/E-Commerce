<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    protected $fillable = ['sid','uid','pid','product_name','product_qty','total_price','product_photo'];
}
