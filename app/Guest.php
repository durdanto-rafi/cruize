<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public $fillable = ['cruize_id','first_name','last_name'];
}