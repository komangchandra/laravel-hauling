<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $guarded = [];

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function hauls()
    {
        return $this->hasMany(Haul::class);
    }
}
