@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código</label>
        <input type="text" name="code" id="code" value="{{ old('code', $coupon->code ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
        @error('code')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
        <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
            <option value="activo" {{ old('status', $coupon->status ?? 'activo') === 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ old('status', $coupon->status ?? '') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        @error('status')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
        <select name="type" id="type" class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
            <option value="percentage" {{ old('type', $coupon->type ?? 'percentage') === 'percentage' ? 'selected' : '' }}>Porcentaje</option>
            <option value="fixed" {{ old('type', $coupon->type ?? '') === 'fixed' ? 'selected' : '' }}>Monto fijo</option>
        </select>
        @error('type')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Valor</label>
        <input type="number" step="0.01" min="0.01" name="value" id="value" value="{{ old('value', $coupon->value ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
        @error('value')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="minimum_total" class="block text-sm font-medium text-gray-700 mb-1">Compra mínima</label>
        <input type="number" step="0.01" min="0" name="minimum_total" id="minimum_total" value="{{ old('minimum_total', $coupon->minimum_total ?? 0) }}"
               class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
        @error('minimum_total')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="usage_limit" class="block text-sm font-medium text-gray-700 mb-1">Límite de usos</label>
        <input type="number" min="1" name="usage_limit" id="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
        @error('usage_limit')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="starts_at" class="block text-sm font-medium text-gray-700 mb-1">Inicia</label>
        <input type="date" name="starts_at" id="starts_at" value="{{ old('starts_at', isset($coupon) && $coupon->starts_at ? $coupon->starts_at->format('Y-m-d') : '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
        @error('starts_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-1">Vence</label>
        <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at', isset($coupon) && $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
        @error('expires_at')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">{{ old('description', $coupon->description ?? '') }}</textarea>
        @error('description')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="flex justify-end gap-3 mt-6">
    <a href="{{ route('admin.coupons.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
        Cancelar
    </a>
    <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
        Guardar
    </button>
</div>
