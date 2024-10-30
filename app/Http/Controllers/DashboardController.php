<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // // Retrieve the authenticated user
        // $user = Auth::user();

        // // Fetch data for the dashboard
        // $dashboardData = Account::query()->where(
        //     'email',
        //     $user->email
        // )->where('password', $user->password)->firstOrFail();
            
        // // Pass the data to the dashboard view
        // return view('anggota/dashboard', [
        //     'user' => $user,
        //     'data' => $dashboardData
        // ]);

        // Check if the admin guard is authenticated
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();

            dd($user);
            // Fetch data specific to admin
            $dashboardData = Admin::find($user->id);

            // Pass the data to the admin dashboard view
            return view('admin/dashboard_admin', [
                'user' => $user,
                'data' => $dashboardData
            ]);
        }

        // Check if the account guard is authenticated
        elseif (Auth::guard('account')->check()) {
            $user = Auth::guard('account')->user();

            // Fetch data specific to account user
            $dashboardData = Account::find($user->id);
            
            // Pass the data to the account dashboard view
            return view('anggota/dashboard', [
                'user' => $user,
                'data' => $dashboardData
            ]);
        }
    }
}
