<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datafile extends Model
{
    protected $fillable = [
        'timestamp',
        'filepath',
        'type',
        'processed',
    ];
}
