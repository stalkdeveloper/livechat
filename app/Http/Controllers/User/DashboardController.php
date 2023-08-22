<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\User\CommonService;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            return view('User.Dashboard.dashboard');
        } catch (\Throwable $e) {
        }
    }
}
