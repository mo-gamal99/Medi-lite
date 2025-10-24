<?php

namespace App\Http\Middleware;

use App\Helper\ApiResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $phone = $request->input('phone_number') ?? $request->header('phone_number');

        $user = User::where('phone_number', $phone)->first();

        if (!$user || !$user->is_active) {
            return ApiResponse::sendResponse(403, 'حسابك غير مفعل، تواصل مع الإدارة.');
        }

        return $next($request);
    }
}
