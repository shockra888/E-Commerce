<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = ['account_id','Customer_Name', 'Customer_Address','Customer_Contact','Gender'];
}
