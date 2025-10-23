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
         $productsCount = Medical::count();
         $ordersCount = Medical::count();
         $usersCount = User::count();
         $messagesCount = Medical::count();
         $adminsCount = \App\Models\Admin::count();
         return view('dashboard.dashboard', \compact('productsCount', 'ordersCount', 'usersCount', 'adminsCount', 'messagesCount'));
      }
   }
