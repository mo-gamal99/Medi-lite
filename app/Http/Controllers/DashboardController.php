<?php

namespace App\Http\Controllers;

use App\currency\Currency;
use App\Http\Middleware\Admin;
use App\Models\ContactUs;
use App\Models\Medical;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $medicinsCount = Medical::count();
        $usersCount = User::count();
        $adminsCount = \App\Models\Admin::count();

        $activeUsersCount = User::where('is_active', 1)->count();
        $notActiveUsersCount = User::where('is_active', 0)->count();
        return view('dashboard.dashboard', \compact(
            'medicinsCount',
            'usersCount',
            'adminsCount',
            'activeUsersCount',
            'notActiveUsersCount'
        ));
    }
}
