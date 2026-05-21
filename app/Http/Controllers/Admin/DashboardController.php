<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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

        $totalProducts = Product::count();
        $totalActiveProducts = Product::where('status', 'activo')->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pendiente')->count();
        $deliveredOrders = Order::where('status', 'entregado')->count();

        $totalSales = OrderItem::sum('subtotal');

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalBannedUsers',
            'totalCategories',
            'totalActiveCategories',
            'totalCommerces',
            'totalActiveCommerces',
            'totalSuspendedCommerces',
            'totalProducts',
            'totalActiveProducts',
            'lowStockProducts',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'totalSales',
            'recentOrders'
        ));
    }
}
