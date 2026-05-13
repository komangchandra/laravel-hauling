<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $guarded = [];

    public function hauls()
    {
        return $this->hasMany(Haul::class);
    }
}
