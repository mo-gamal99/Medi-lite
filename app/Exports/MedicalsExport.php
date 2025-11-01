<?php

namespace App\Exports;

use App\Models\Medical;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicalsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Medical::select([
            'barcode',
            'name_ar',
            'name_en',
            'indication',
            'dosage',
            'composistion',
            'strength',
            'company',
            'net',
            'public',
            'pregnancy',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'barcode',
            'name_ar',
            'name_en',
            'indication',
            'dosage',
            'composistion',
            'strength',
            'company',
            'net',
            'public',
            'pregnancy',
        ];
    }
}
