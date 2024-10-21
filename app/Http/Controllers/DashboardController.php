<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Fetch data for the dashboard
        $dashboardData = Account::query()->where(
            'email',
            $user->email
        )->where('password', $user->password)->firstOrFail();
            
        // Pass the data to the dashboard view
        return view('anggota/dashboard', [
            'user' => $user,
            'data' => $dashboardData
        ]);
    }
}
