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

    // public function checkActive($phone)
    // {
    //     $user = User::where('phone_number', $phone)->first();

    //     if (!$user) {
    //         return ApiResponse::sendResponse(404, 'المستخدم غير موجود.');
    //     }

    //     if (!$user->is_active) {
    //         return ApiResponse::sendResponse(403, 'الحساب غير مفعل بعد، تواصل مع الإدارة لتفعيله.');
    //     }

    //     return ApiResponse::sendResponse(200, 'الحساب مفعل ويمكنك استخدام التطبيق.');
    // }
    public function checkActive(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'device_id' => 'required',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return ApiResponse::sendResponse(404, 'المستخدم غير موجود.');
        }

        if (!$user->is_active) {
            return ApiResponse::sendResponse(403, 'الحساب غير مفعل.');
        }

        if ($user->device_id && $user->device_id !== $request->device_id) {
            return ApiResponse::sendResponse(403, 'تم تسجيل الحساب على جهاز آخر. لا يمكن استخدامه من هذا الجهاز.');
        }

        if (!$user->device_id) {
            $user->update([
                'device_id' => $request->device_id,
            ]);
        }

        return ApiResponse::sendResponse(200, 'الحساب مفعل ويمكنك استخدام التطبيق.');
    }
}
