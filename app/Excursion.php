<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excursion extends Model
{
    public $fillable = ['title', 'from', 'to', 'time', 'price', 'max_number_of_guest'];
}