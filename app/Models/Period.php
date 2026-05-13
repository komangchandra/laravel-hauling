<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = [];

    public function hauls()
    {
        return $this->hasMany(Haul::class);
    }

    public function getMonthNameAttribute()
    {
        return match ($this->month) {
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
            default => '-',
        };
    }
}
