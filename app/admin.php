<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $fillable = ['account_id','Admin_Name','Admin_Address','Admin_Contact','Gender'];
}
