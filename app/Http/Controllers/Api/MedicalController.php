<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalResource;
use App\Models\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MedicalController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->get('q'));
        $page   = $request->get('page', 1);

        $cacheKey = "medicals_{$page}_" . md5($search);

        $medicals = Cache::remember($cacheKey, 300, function () use ($search) {
            $query = Medical::query();

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name_ar', 'LIKE', "%$search%")
                        ->orWhere('name_en', 'LIKE', "%$search%")
                        ->orWhere('company', 'LIKE', "%$search%")
                        ->orWhere('strength', 'LIKE', "%$search%")
                        ->orWhere('indication', 'LIKE', "%$search%");
                });
            }

            // paginate بـ 30 record فقط لتسريع الـ response
            return $query->select(['id', 'indication', 'name_ar', 'name_en', 'company', 'strength'])
                ->orderByDesc('id')
                ->paginate(30);
        });

        return MedicalResource::collection($medicals);
    }


    public function show(Medical $medical)
    {
        return new MedicalResource($medical);
    }
}
