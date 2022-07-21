<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $fillable = ['account_id','Supplier_Name', 'Supplier_Address', 'Supplier_Contact','Gender'];
}
