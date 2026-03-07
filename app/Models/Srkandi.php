<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Srkandi extends Model
{
    protected $fillable = [
        'identifier',
        'first_name',
        'last_name',
        'party',
    ];

    public function results()
    {
        return $this->hasMany(Srresult::class);
    }
}
