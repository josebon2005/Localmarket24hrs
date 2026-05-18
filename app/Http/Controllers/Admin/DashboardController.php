<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal del administrador.
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
