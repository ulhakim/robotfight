<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    protected $fillable = [
        'player1',
        'player2',
        'winner',
        'loser'     
    ];
}
