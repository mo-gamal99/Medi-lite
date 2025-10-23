<?php

namespace App\Imports;

use App\Models\Medical;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Contracts\Queue\ShouldQueue;

class MedicalsImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, ShouldQueue
{
    /**
     * تحويل كل صف إلى موديل
     */
    public function model(array $row)
    {
        // تجاهل الصفوف الفاضية
        if (!isset($row['name_ar']) && !isset($row['name_en'])) {
            return null;
        }

        return new Medical([
            'barcode'       => $row['barcode'] ?? null,
            'name_ar'       => $row['name_ar'] ?? null,
            'name_en'       => $row['name_en'] ?? null,
            'indication'    => $row['indication'] ?? null,
            'dosage'        => $row['dosage'] ?? null,
            'composistion'  => $row['composistion'] ?? null,
            'strength'      => $row['strength'] ?? null,
            'company'       => $row['company'] ?? null,
            'net'           => $row['net'] ?? null,
            'public'        => $row['public'] ?? null,
            'pregnancy'     => $row['pregnancy'] ?? null,
        ]);
    }

    /**
     * حجم كل chunk (كم صف يقرأ في المرة)
     */
    public function chunkSize(): int
    {
        return 1000; // أو 2000 حسب الذاكرة عندك
    }

    /**
     * حجم batch insert (كم صف يدخل دفعة واحدة)
     */
    public function batchSize(): int
    {
        return 500;
    }
}
