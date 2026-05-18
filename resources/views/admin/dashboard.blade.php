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
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Total de usuarios en la plataforma</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios creados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios registrados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Categorías disponibles</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pedidos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
                <p class="text-xs text-gray-400 mt-2">Pedidos realizados</p>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800">
                Primer avance del módulo administrador
            </h2>

            <p class="text-gray-500 mt-2">
                Este dashboard todavía muestra datos de prueba. Más adelante se conectará con la base de datos para mostrar usuarios, comercios, categorías, productos, pedidos y ventas reales.
            </p>
        </div>

    </div>
@endsection
