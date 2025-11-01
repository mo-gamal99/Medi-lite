<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Medical;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $medicinsCount = Medical::count();
        $usersCount = User::count();
        $adminsCount = Admin::count();
        $activeUsersCount = User::where('is_active', 1)->count();
        $notActiveUsersCount = User::where('is_active', 0)->count();

        // إحصائيات المستخدمين لكل شهر
        $monthlyStats = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_count'),
            DB::raw('SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as inactive_count')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // نحضر البيانات في شكل مناسب للـ chart
        $months = [
            'يناير',
            'فبراير',
            'مارس',
            'ابريل',
            'مايو',
            'يونيو',
            'يوليو',
            'اغسطس',
            'سبتمبر',
            'اكتوبر',
            'نوفمبر',
            'ديسمبر'
        ];

        $activeData = array_fill(0, 12, 0);
        $inactiveData = array_fill(0, 12, 0);

        foreach ($monthlyStats as $stat) {
            $index = $stat->month - 1;
            $activeData[$index] = $stat->active_count;
            $inactiveData[$index] = $stat->inactive_count;
        }

        return view('dashboard.dashboard', compact(
            'medicinsCount',
            'usersCount',
            'adminsCount',
            'activeUsersCount',
            'notActiveUsersCount',
            'months',
            'activeData',
            'inactiveData'
        ));
    }
}
