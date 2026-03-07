<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Srresult extends Model
{
    protected $fillable = [
        'votes',
        'srkandi_id',
        'district_id',
    ];

    public function candidate()
    {
        return $this->belongsTo(Srkandi::class, 'srkandi_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
