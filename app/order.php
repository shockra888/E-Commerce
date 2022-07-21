<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = ['sid','total_pay','pid','AccntID','customer_name','customer_address','Customer_Contact','product_name','product_qty','total_price','status','date_of_order'];
}
