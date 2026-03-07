<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stapiresult extends Model
{
    protected $fillable = [
        'votes',
        'stapikandi_id',
        'district_id',
    ];

    public function candidate()
    {
        return $this->belongsTo(Stapikandi::class, 'stapikandi_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
