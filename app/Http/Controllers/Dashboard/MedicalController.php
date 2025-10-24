<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\MedicalsImport;
use App\Models\Medical;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MedicalController extends Controller
{
    public function index(Request $request)
    {
        $query = Medical::query();

        // فلترة بالبحث لو فيه كلمة
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qBuilder) use ($q) {
                $qBuilder->where('name_ar', 'LIKE', "%$q%")
                    ->orWhere('name_en', 'LIKE', "%$q%")
                    ->orWhere('company', 'LIKE', "%$q%")
                    ->orWhere('strength', 'LIKE', "%$q%")
                    ->orWhere('indication', 'LIKE', "%$q%");

            });
        }

        $medicals = $query->orderByDesc('id')->paginate(25);

        return view('dashboard.medicals.index', compact('medicals'));
    }

    // ✅ رفع ملف Excel
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // Excel::import(new MedicalsImport, $request->file('file'));
        Excel::queueImport(new MedicalsImport(), $request->file('file'));


        return back()->with('success', 'تم رفع بيانات الأدوية بنجاح ✅');
    }

    // ✅ صفحة تعديل دواء
    public function edit(Medical $medical)
    {
        return view('dashboard.medicals.edit', compact('medical'));
    }

    // ✅ حفظ التعديلات
    public function update(Request $request, Medical $medical)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
        ]);

        $medical->update($request->all());

        return redirect()->route('medicals.index')->with('success', 'تم تحديث بيانات الدواء بنجاح ✅');
    }
}
