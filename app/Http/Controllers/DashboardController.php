<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's role-based dashboard.
     */
    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'role' => Auth::user()->role,
            'user' => Auth::user(),
        ]);
    }
}
