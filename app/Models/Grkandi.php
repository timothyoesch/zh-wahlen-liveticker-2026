<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grkandi extends Model
{
    protected $fillable = ['number', 'first_name', 'last_name', 'party', 'incumbent', 'votes', 'ranking', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
