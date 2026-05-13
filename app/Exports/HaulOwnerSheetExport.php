<?php

namespace App\Exports;

use App\Models\Haul;
use App\Models\Track;
use App\Models\Partner;
use App\Models\Period;
use App\Models\Owner;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class HaulOwnerSheetExport implements FromCollection, WithTitle
{
    protected $owner;

    public function __construct(Owner $owner)
    {
        $this->owner = $owner;
    }

    public function title(): string
    {
        return $this->owner->short_name;
    }

    public function collection()
    {
        $rows = collect();

        /*
        |--------------------------------------------------------------------------
        | PERIODE
        |--------------------------------------------------------------------------
        */

        $periods = Period::orderBy('year')
            ->orderBy('month')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | HEADER TAHUN
        |--------------------------------------------------------------------------
        */

        $headerYear = ['', '', ''];

        foreach ($periods as $period) {
            $headerYear[] = $period->year;
        }

        $rows->push($headerYear);

        /*
        |--------------------------------------------------------------------------
        | HEADER BULAN
        |--------------------------------------------------------------------------
        */

        $headerMonth = ['', '', ''];

        foreach ($periods as $period) {

            $monthName = match ((int) $period->month) {
                1 => 'JANUARI',
                2 => 'FEBRUARI',
                3 => 'MARET',
                4 => 'APRIL',
                5 => 'MEI',
                6 => 'JUNI',
                7 => 'JULI',
                8 => 'AGUSTUS',
                9 => 'SEPTEMBER',
                10 => 'OKTOBER',
                11 => 'NOVEMBER',
                12 => 'DESEMBER',
                default => '-',
            };

            $headerMonth[] = $monthName;
        }

        $rows->push($headerMonth);

        /*
        |--------------------------------------------------------------------------
        | HEADER PERIODE
        |--------------------------------------------------------------------------
        */

        $headerPeriod = [
            'No',
            'Nama Perusahaan',
            'Rute',
        ];

        foreach ($periods as $period) {
            $headerPeriod[] = $period->name;
        }

        $rows->push($headerPeriod);

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $partners = Partner::orderBy('legal_name')->get();

        $tracks = Track::orderBy('name')->get();

        $no = 1;

        foreach ($partners as $partner) {

            $firstTrack = true;

            foreach ($tracks as $track) {

                $row = [];

                if ($firstTrack) {

                    $row[] = $no;
                    $row[] = $partner->legal_name;

                    $firstTrack = false;

                } else {

                    $row[] = '';
                    $row[] = '';
                }

                $row[] = $track->name;

                /*
                |--------------------------------------------------------------------------
                | TONASE BERDASARKAN OWNER
                |--------------------------------------------------------------------------
                */

                foreach ($periods as $period) {

                    $tonage = Haul::where('owner_id', $this->owner->id)
                        ->where('partner_id', $partner->id)
                        ->where('track_id', $track->id)
                        ->where('period_id', $period->id)
                        ->sum('tonage');

                    $row[] = $tonage > 0
                        ? number_format($tonage, 2)
                        : '';
                }

                $rows->push($row);
            }

            $no++;
        }

        return $rows;
    }
}