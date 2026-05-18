<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalNormalUsers = User::where('role', 'usuario')->count();
        $totalMerchants = User::where('role', 'comerciante')->count();
        $totalBannedUsers = User::where('status', 'baneado')->count();

        $totalCategories = Category::count();
        $totalActiveCategories = Category::where('status', 'activa')->count();
        $totalInactiveCategories = Category::where('status', 'inactiva')->count();

        $totalCommerces = Commerce::count();
        $totalActiveCommerces = Commerce::where('status', 'activo')->count();
        $totalSuspendedCommerces = Commerce::where('status', 'suspendido')->count();
        $totalInactiveCommerces = Commerce::where('status', 'inactivo')->count();

        $recentUsers = User::latest()->take(5)->get();
        $recentCategories = Category::latest()->take(5)->get();
        $recentCommerces = Commerce::with(['user', 'category'])->latest()->take(5)->get();

        return view('admin.reports.index', compact(
            'totalUsers',
            'totalAdmins',
            'totalNormalUsers',
            'totalMerchants',
            'totalBannedUsers',
            'totalCategories',
            'totalActiveCategories',
            'totalInactiveCategories',
            'totalCommerces',
            'totalActiveCommerces',
            'totalSuspendedCommerces',
            'totalInactiveCommerces',
            'recentUsers',
            'recentCategories',
            'recentCommerces'
        ));
    }
}
