<?php

namespace App\Http\Middleware;

use App\Helper\ApiResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUser
{
    public function handle($request, Closure $next)
    {
        $identifier = $request->header('device_id')
            ?? $request->header('phone_number')
            ?? $request->input('device_id')
            ?? $request->input('phone_number');

        \Log::info('🔍 CheckActiveUser Middleware Triggered', [
            'headers' => $request->headers->all(),
            'inputs' => $request->all(),
            'identifier_used' => $identifier,
        ]);

        $user = User::where('device_id', $identifier)
            ->orWhere('phone_number', $identifier)
            ->first();

        \Log::info('👤 User Lookup Result', [
            'identifier' => $identifier,
            'user_found' => $user ? true : false,
            'user_id' => $user->id ?? null,
            'user_phone' => $user->phone_number ?? null,
            'user_active' => $user->is_active ?? null,
        ]);

        if (!$user || !$user->is_active) {
            \Log::warning('🚫 Blocked Inactive or Missing User', [
                'identifier' => $identifier,
                'reason' => !$user ? 'User not found' : 'User inactive',
            ]);

            return ApiResponse::sendResponse(403, 'حسابك غير مفعل، تواصل مع الإدارة.');
        }

        return $next($request);
    }
}
