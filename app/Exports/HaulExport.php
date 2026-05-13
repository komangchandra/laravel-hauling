<?php

namespace App\Exports;

use App\Models\Haul;
use App\Models\Track;
use App\Models\Partner;
use App\Models\Period;
// use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class HaulExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rows = collect();

        // Ambil semua periode
        $periods = Period::orderBy('year')
            ->orderBy('month')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | HEADER TAHUN
        |--------------------------------------------------------------------------
        */

        $headerYear = [
            '',
            '',
            '',
        ];

        foreach ($periods as $period) {
            $headerYear[] = $period->year;
        }

        $rows->push($headerYear);

        /*
        |--------------------------------------------------------------------------
        | HEADER BULAN
        |--------------------------------------------------------------------------
        */

        $headerMonth = [
            '',
            '',
            '',
        ];

        foreach ($periods as $period) {

            $monthName = match ($period->month) {
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

                // Nomor dan nama perusahaan hanya sekali
                if ($firstTrack) {

                    $row[] = $no;
                    $row[] = $partner->legal_name;

                    $firstTrack = false;

                } else {

                    $row[] = '';
                    $row[] = '';
                }

                // Nama rute
                $row[] = $track->name;

                // Semua periode
                foreach ($periods as $period) {

                    $tonage = Haul::where('partner_id', $partner->id)
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