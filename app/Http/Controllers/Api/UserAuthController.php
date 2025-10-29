<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'ip_address' => $request->ip_address ?? $request->ip(),
            'device_id' => $request->device_id,
            'is_active' => false,
        ]);

        return ApiResponse::sendResponse(200, 'تم تسجيل بياناتك بنجاح، في انتظار تفعيل الحساب.', [
            'user' => $user,
        ]);
    }
    public function checkActive(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
        ]);

        $user = User::where('device_id', $request->device_id)->first();

        if (!$user) {
            return ApiResponse::sendResponse(404, 'لم يتم العثور على مستخدم مرتبط بهذا الجهاز.');
        }

        // لو مش مفعل
        if (!$user->is_active) {
            return ApiResponse::sendResponse(403, 'الحساب غير مفعل.');
        }

        // لو انتهت المدة
        if ($user->expires_at && now()->greaterThan($user->expires_at)) {
            $user->update(['is_active' => false]);
            return ApiResponse::sendResponse(403, 'انتهت صلاحية الحساب. برجاء تجديد التفعيل.');
        }

        // حساب باقي الأيام
        $daysRemaining = $user->expires_at
            ? now()->diffInDays($user->expires_at, false)
            : null;

        return ApiResponse::sendResponse(200, 'الحساب مفعل.', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'is_active' => $user->is_active,
                'activated_at' => $user->activated_at,
                'expires_at' => $user->expires_at,
                'days_remaining' => $daysRemaining,
            ]
        ]);
    }

}
