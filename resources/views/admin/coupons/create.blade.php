@extends('admin.layouts.app')

@section('title', 'Crear Cupón')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Nuevo cupón</h1>
            <p class="text-gray-500 mb-6">Configura el descuento y su vigencia.</p>

            <form method="POST" action="{{ route('admin.coupons.store') }}">
                @include('admin.coupons._form')
            </form>
        </div>
    </div>
@endsection
