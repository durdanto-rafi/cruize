<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cruize extends Model
{
    public $fillable = ['name', 'ship_name', 'from', 'to', 'uniq_id'];
}