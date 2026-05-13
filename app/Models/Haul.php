<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haul extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
