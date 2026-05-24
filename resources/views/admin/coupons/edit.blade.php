@extends('admin.layouts.app')

@section('title', 'Editar Cupón')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Editar cupón</h1>
            <p class="text-gray-500 mb-6">Actualiza las condiciones del descuento.</p>

            <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
                @method('PUT')
                @include('admin.coupons._form')
            </form>
        </div>
    </div>
@endsection
