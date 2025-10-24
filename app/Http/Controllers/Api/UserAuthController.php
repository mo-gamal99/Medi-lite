<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;

class UserAuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'ip_address' => $request->ip(),
            'is_active' => false,
        ]);

        return ApiResponse::sendResponse(200, 'تم تسجيل بياناتك بنجاح، في انتظار تفعيل الحساب.', [
            'user' => $user,
        ]);
    }

    public function checkActive($phone)
    {
        $user = User::where('phone_number', $phone)->first();

        if (!$user) {
            return ApiResponse::sendResponse(404, 'المستخدم غير موجود.');
        }

        if (!$user->is_active) {
            return ApiResponse::sendResponse(403, 'الحساب غير مفعل بعد، تواصل مع الإدارة لتفعيله.');
        }

        return ApiResponse::sendResponse(200, 'الحساب مفعل ويمكنك استخدام التطبيق.');
    }
}
