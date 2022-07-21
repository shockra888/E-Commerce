<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $fillable = ['username','email','password','account_type'];
}
