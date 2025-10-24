<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medical;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DataExportController extends Controller
{
    public function export()
    {
        $filePath = 'public/medicals.json';

        // 🧹 امسح الملف القديم لو موجود
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // 📝 افتح ملف جديد للكتابة
        $fullPath = storage_path('app/' . $filePath);
        $file = fopen($fullPath, 'w');
        fwrite($file, '[');

        $first = true;

        // 🧩 اكتب الداتا على شكل JSON مجزأ
        Medical::chunk(1000, function ($rows) use ($file, &$first) {
            foreach ($rows as $row) {
                if (!$first) {
                    fwrite($file, ',');
                }
                fwrite($file, $row->toJson(JSON_UNESCAPED_UNICODE));
                $first = false;
            }
        });

        fwrite($file, ']');
        fclose($file);

        return response()->json([
            'status' => true,
            'message' => 'تم إنشاء الملف بنجاح',
            'file_url' => url('storage/medicals.json'),
            'last_updated_at' => now()->toDateTimeString(),
        ]);
    }
}
