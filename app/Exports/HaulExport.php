<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HaulExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $owners = Owner::orderBy('short_name')->get();

        foreach ($owners as $owner) {

            $sheets[] = new HaulOwnerSheetExport($owner);

        }

        return $sheets;
    }
}