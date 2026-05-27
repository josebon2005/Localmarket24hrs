@extends('admin.layouts.app')

@section('title', 'Repartidores')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Repartidores</h1>
            <p class="text-gray-500 mt-1">Crea repartidores y asignales pedidos para servicio a domicilio.</p>
        </div>

        <section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Crear repartidor</h2>

            <form method="POST" action="{{ route('admin.delivery.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contrasena</label>
                    <input id="password" name="password" type="password"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div class="md:col-span-4">
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Crear repartidor
                    </button>
                </div>
            </form>
        </section>

        <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Repartidores registrados</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 border-b">
                    <tr>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Correo</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Pedidos asignados</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse ($repartidores as $repartidor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $repartidor->name }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $repartidor->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full {{ $repartidor->status === 'activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($repartidor->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $repartidor->deliveryOrders()->count() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">No hay repartidores registrados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $repartidores->links() }}
            </div>
        </section>

        <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Asignar pedidos</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 border-b">
                    <tr>
                        <th class="px-6 py-3">Pedido</th>
                        <th class="px-6 py-3">Comprador</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Entrega</th>
                        <th class="px-6 py-3">Repartidor</th>
                        <th class="px-6 py-3 text-right">Guardar</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $order->user->name ?? 'Sin comprador' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $order->statusLabel() }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $order->deliveryStatusLabel() }}</td>
                            <td class="px-6 py-4">
                                <form id="assign-order-{{ $order->id }}" method="POST" action="{{ route('admin.delivery.assign', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="delivery_user_id"
                                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                                        <option value="">Sin asignar</option>
                                        @foreach ($activeRepartidores as $repartidor)
                                            <option value="{{ $repartidor->id }}" {{ $order->delivery_user_id === $repartidor->id ? 'selected' : '' }}>
                                                {{ $repartidor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button type="submit"
                                        form="assign-order-{{ $order->id }}"
                                        class="px-3 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                                    Guardar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">No hay pedidos para asignar.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $orders->links() }}
            </div>
        </section>
    </div>
@endsection
