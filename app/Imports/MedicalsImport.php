<?php

namespace App\Imports;

use App\Models\Medical;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Contracts\Queue\ShouldQueue;

class MedicalsImport implements ToModel, WithChunkReading, WithBatchInserts, ShouldQueue
{
    /**
     * تحويل كل صف إلى موديل
     */
    public function model(array $row)
    {
        // تجاهل الصف الأول لو فيه هيدرز أو صفوف فاضية
        if (
            !isset($row[1]) && !isset($row[2]) ||
            $row[0] === 'barcode' || $row[1] === 'name_ar'
        ) {
            return null;
        }

        return new Medical([
            'barcode'       => $row[0] ?? null,  // العمود A
            'name_ar'       => $row[1] ?? null,  // العمود B
            'name_en'       => $row[2] ?? null,  // العمود C
            'indication'    => $row[3] ?? null,  // العمود D
            'dosage'        => $row[4] ?? null,  // العمود E
            'composistion'  => $row[5] ?? null,  // العمود F
            'strength'      => $row[6] ?? null,  // العمود G
            'company'       => $row[7] ?? null,  // العمود H
            'net'           => $row[8] ?? null,  // العمود I
            'public'        => $row[9] ?? null,  // العمود J
            'pregnancy'     => $row[10] ?? null, // العمود K
        ]);
    }

    /**
     * حجم كل chunk (كم صف يقرأ في المرة)
     */
    public function chunkSize(): int
    {
        return 1000; // يمكنك زيادتها لو السيرفر قوي
    }

    /**
     * حجم batch insert (كم صف يدخل دفعة واحدة)
     */
    public function batchSize(): int
    {
        return 500;
    }
}
