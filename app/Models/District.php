<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'number',
        'name',
        'done',
        'donesr',
        'donestapi',
    ];

    public function partyResults()
    {
        return $this->hasMany(Partyresult::class);
    }

    public function candidateResults()
    {
        return $this->hasMany(Grkandi::class);
    }

    public function srCandidateResults()
    {
        return $this->hasMany(Srresult::class);
    }
}
