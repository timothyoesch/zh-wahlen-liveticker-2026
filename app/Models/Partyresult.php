<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partyresult extends Model
{
    protected $fillable = ['party', 'votes', 'electors', 'percentage', 'change', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
