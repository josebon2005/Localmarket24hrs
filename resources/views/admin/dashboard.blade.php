@extends('admin.layouts.app')

@section('title', 'Dashboard Administrativo')

@section('content')
    <div class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Bienvenido al panel administrativo
            </h1>

            <p class="text-gray-500 mt-2">
                Desde aquí podrás gestionar usuarios, comercios, categorías y reportes generales de LocalMarket 24hrs.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Usuarios registrados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Total de usuarios en la plataforma</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Administradores</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalAdmins }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios con rol administrador</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">Categorías registradas</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías activas</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">Categorías disponibles para comercios</p>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Usuarios baneados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalBannedUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios restringidos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios creados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios registrados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios activos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios habilitados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios suspendidos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSuspendedCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios restringidos</p>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Productos registrados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Se conectará cuando creemos productos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pedidos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Se conectará cuando creemos pedidos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Ventas generales</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Q0.00</h3>
                <p class="text-xs text-gray-400 mt-2">Se conectará con pedidos pagados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Reportes</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Se completará más adelante</p>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800">
                Avance del módulo administrador
            </h2>

            <p class="text-gray-500 mt-2">
                Este dashboard ya muestra datos reales de usuarios, administradores, categorías y comercios. Los productos, pedidos, ventas y reportes se conectarán cuando creemos esos módulos.
            </p>
        </div>

    </div>
@endsection
