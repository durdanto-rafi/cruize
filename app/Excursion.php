<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excursion extends Model
{
    public $fillable = ['cruize_id','title', 'from', 'to', 'time', 'price', 'max_number_of_guest', 'uniq_id'];
}