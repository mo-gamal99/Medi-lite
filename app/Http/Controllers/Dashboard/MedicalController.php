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

        $medicals = $query->orderByDesc('id')->paginate(25)->appends(['q' => $request->q]);

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
    public function create()
    {
        return view('dashboard.medicals.create');
    }

    // ✅ حفظ دواء جديد
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => ['nullable', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'composistion' => ['nullable', 'string', 'max:255'],
            'strength' => ['nullable', 'string', 'max:255'],
            'dosage' => ['nullable', 'string', 'max:255'],
            'indication' => ['nullable', 'string', 'max:255'],
            'net' => 'nullable|numeric|min:0|max:99999999.99',
            'public' => 'nullable|numeric|min:0|max:99999999.99',
            'pregnancy' => ['nullable', 'string', 'max:255'],
        ]);


        Medical::create($request->all());

        return redirect()->route('medicals.index')->with('success', 'تم إضافة الدواء بنجاح ✅');
    }


    // ✅ صفحة تعديل دواء
    public function edit(Medical $medical)
    {
        return view('dashboard.medicals.edit', compact('medical'));
    }

    public function update(Request $request, Medical $medical)
    {
        $request->validate([
            'barcode' => 'nullable|string|max:255',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'composistion' => 'nullable|string|max:255',
            'strength' => 'nullable|string|max:255',
            'indication' => 'nullable|string|max:255',
            'net' => 'nullable|numeric|min:0|max:99999999.99',
            'public' => 'nullable|numeric|min:0|max:99999999.99',
            'pregnancy' => 'nullable|string|max:255',
        ]);

        $medical->update($request->all());

        return redirect()->route('medicals.index')->with('success', 'تم تحديث بيانات الدواء بنجاح ✅');
    }



    // ✅ عرض التفاصيل
    public function show(Medical $medical)
    {
        return view('dashboard.medicals.show', compact('medical'));
    }

    // 🗑 حذف عنصر واحد
    public function destroy(Medical $medical)
    {
        $medical->delete();
        return redirect()->route('medicals.index')->with('success', 'تم حذف الدواء بنجاح 🗑️');
    }

    // 🚨 حذف جميع الأدوية
    public function destroyAll()
    {
        Medical::truncate();
        return redirect()->route('medicals.index')->with('success', 'تم حذف جميع الأدوية بنجاح 🧹');
    }
}
