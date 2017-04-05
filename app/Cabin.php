<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    public $fillable = ['cabin_number', 'guest_id', 'number_of_guest', 'payment_status', 'uniq_id'];
}