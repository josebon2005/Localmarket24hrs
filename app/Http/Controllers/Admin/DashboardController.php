<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalBannedUsers = User::where('status', 'baneado')->count();

        $totalCategories = Category::count();
        $totalActiveCategories = Category::where('status', 'activa')->count();

        $totalCommerces = Commerce::count();
        $totalActiveCommerces = Commerce::where('status', 'activo')->count();
        $totalSuspendedCommerces = Commerce::where('status', 'suspendido')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalBannedUsers',
            'totalCategories',
            'totalActiveCategories',
            'totalCommerces',
            'totalActiveCommerces',
            'totalSuspendedCommerces'
        ));
    }
}
