<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $fillable = [
        'robot_name',
        'robot_colour',
        'robot_owner',
        'robot_speed',
        'robot_weight',
        'robot_power'       
    ];
}







