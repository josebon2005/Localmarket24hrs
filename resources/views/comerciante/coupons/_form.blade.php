@csrf

@php
    $isEdit     = isset($coupon);
    $oldCode    = old('code',        $isEdit ? $coupon->code        : '');
    $oldType    = old('type',        $isEdit ? $coupon->type        : 'percentage');
    $oldValue   = old('value',       $isEdit ? $coupon->value       : '');
    $oldMin     = old('minimum_total',$isEdit ? $coupon->minimum_total : 0);
    $oldLimit   = old('usage_limit', $isEdit ? $coupon->usage_limit : '');
    $oldStatus  = old('status',      $isEdit ? $coupon->status      : 'activo');
    $oldDesc    = old('description', $isEdit ? $coupon->description : '');
    $oldStarts  = old('starts_at',   $isEdit && $coupon->starts_at  ? $coupon->starts_at->format('Y-m-d')  : '');
    $oldExpires = old('expires_at',  $isEdit && $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '');
@endphp

<div x-data="{
    code:    '{{ addslashes($oldCode) }}',
    type:    '{{ $oldType }}',
    value:   '{{ $oldValue }}',
    minimum: '{{ $oldMin }}',
    expires: '{{ $oldExpires }}',
    status:  '{{ $oldStatus }}',
    get preview() {
        return this.code.trim() || 'MICUPON';
    },
    get discountLabel() {
        if (!this.value) return '—';
        return this.type === 'fixed'
            ? 'Q' + parseFloat(this.value || 0).toFixed(2)
            : parseFloat(this.value || 0).toFixed(0) + '%';
    },
    get minLabel() {
        return parseFloat(this.minimum || 0) > 0
            ? 'Compra mínima Q' + parseFloat(this.minimum).toFixed(2)
            : 'Sin compra mínima';
    },
    get expiresLabel() {
        if (!this.expires) return 'Sin vencimiento';
        const d = new Date(this.expires + 'T12:00:00');
        return 'Vence ' + d.toLocaleDateString('es', { day:'2-digit', month:'short', year:'numeric' });
    }
}" class="space-y-8">

    {{-- ══ GRID PRINCIPAL ══ --}}
    <div class="grid lg:grid-cols-5 gap-8 items-start">

        {{-- ── CAMPOS (3 cols) ── --}}
        <div class="lg:col-span-3 space-y-5">

            @if ($errors->any())
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-red-50 border border-red-200">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <ul class="text-sm text-red-600 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>· {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Código --}}
            <div>
                <label for="code" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                    Código del cupón <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <input type="text" name="code" id="code"
                           x-model="code"
                           @input="code = $event.target.value.toUpperCase()"
                           placeholder="Ej: VERANO20"
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('code') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 font-mono font-bold tracking-wider placeholder-gray-300 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none uppercase">
                </div>
                <p class="text-xs text-gray-400 mt-1.5">El código se guardará en mayúsculas. Solo letras, números y guiones.</p>
                @error('code')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Tipo de descuento --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                    Tipo de descuento <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="percentage" x-model="type" class="sr-only peer">
                        <div class="flex items-center gap-3 p-4 rounded-xl border-2 border-gray-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 peer-checked:bg-orange-100 flex items-center justify-center shrink-0 transition-colors"
                                 :class="type === 'percentage' ? 'bg-orange-100' : 'bg-gray-100'">
                                <span class="text-base font-black" :class="type === 'percentage' ? 'text-orange-600' : 'text-gray-400'">%</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm" :class="type === 'percentage' ? 'text-orange-700' : 'text-gray-600'">Porcentaje</p>
                                <p class="text-xs text-gray-400">Ej: 20% off</p>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="fixed" x-model="type" class="sr-only peer">
                        <div class="flex items-center gap-3 p-4 rounded-xl border-2 border-gray-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 transition-colors"
                                 :class="type === 'fixed' ? 'bg-orange-100' : 'bg-gray-100'">
                                <span class="text-base font-black" :class="type === 'fixed' ? 'text-orange-600' : 'text-gray-400'">Q</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm" :class="type === 'fixed' ? 'text-orange-700' : 'text-gray-600'">Monto fijo</p>
                                <p class="text-xs text-gray-400">Ej: Q25.00 off</p>
                            </div>
                        </div>
                    </label>
                </div>
                @error('type')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Valor + Mínimo --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="value" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                        Valor <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="text-gray-400 font-bold text-sm" x-text="type === 'fixed' ? 'Q' : '%'"></span>
                        </div>
                        <input type="number" step="0.01" min="0.01" name="value" id="value"
                               x-model="value"
                               placeholder="0.00"
                               class="w-full pl-8 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('value') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                    </div>
                    @error('value')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="minimum_total" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                        Compra mínima
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="text-gray-400 font-bold text-sm">Q</span>
                        </div>
                        <input type="number" step="0.01" min="0" name="minimum_total" id="minimum_total"
                               x-model="minimum"
                               placeholder="0.00"
                               class="w-full pl-8 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('minimum_total') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Deja en 0 para sin mínimo</p>
                    @error('minimum_total')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Fechas --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="starts_at" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                        Fecha de inicio
                    </label>
                    <input type="date" name="starts_at" id="starts_at"
                           value="{{ $oldStarts }}"
                           class="w-full px-4 py-2.5 rounded-xl border-2 {{ $errors->has('starts_at') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1.5">Vacío = aplica desde hoy</p>
                    @error('starts_at')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="expires_at" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                        Fecha de vencimiento
                    </label>
                    <input type="date" name="expires_at" id="expires_at"
                           x-model="expires"
                           class="w-full px-4 py-2.5 rounded-xl border-2 {{ $errors->has('expires_at') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1.5">Vacío = sin vencimiento</p>
                    @error('expires_at')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Límite de usos + Estado --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="usage_limit" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                        Límite de usos
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <input type="number" min="1" name="usage_limit" id="usage_limit"
                               value="{{ $oldLimit }}"
                               placeholder="Sin límite"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('usage_limit') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                    </div>
                    @error('usage_limit')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                        Estado
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="activo" x-model="status" class="sr-only peer">
                            <div class="flex items-center justify-center gap-1.5 py-2.5 rounded-xl border-2 border-gray-200 peer-checked:border-green-400 peer-checked:bg-green-50 text-xs font-bold text-gray-400 peer-checked:text-green-700 transition-all">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300 peer-checked:bg-green-400"
                                      :class="status === 'activo' ? 'bg-green-400' : 'bg-gray-300'"></span>
                                <span :class="status === 'activo' ? 'text-green-700' : 'text-gray-400'">Activo</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="inactivo" x-model="status" class="sr-only peer">
                            <div class="flex items-center justify-center gap-1.5 py-2.5 rounded-xl border-2 border-gray-200 peer-checked:border-gray-400 peer-checked:bg-gray-50 text-xs font-bold transition-all"
                                 :class="status === 'inactivo' ? 'border-gray-400 bg-gray-50 text-gray-600' : 'text-gray-400'">
                                <span class="w-1.5 h-1.5 rounded-full" :class="status === 'inactivo' ? 'bg-gray-400' : 'bg-gray-300'"></span>
                                <span>Inactivo</span>
                            </div>
                        </label>
                    </div>
                    @error('status')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Descripción --}}
            <div>
                <label for="description" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                    Descripción para el comprador
                </label>
                <textarea name="description" id="description" rows="3"
                          placeholder="Ej: Descuento especial de verano. Válido en toda la tienda."
                          class="w-full px-4 py-2.5 rounded-xl border-2 {{ $errors->has('description') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 placeholder-gray-300 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none resize-none">{{ $oldDesc }}</textarea>
                @error('description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- ── PREVIEW (2 cols) ── --}}
        <div class="lg:col-span-2">
            <div class="sticky top-24 space-y-4">

                {{-- Preview card --}}
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Vista previa del cupón</p>

                    <div class="relative rounded-3xl overflow-hidden shadow-xl"
                         :class="status === 'activo' ? 'bg-gradient-to-br from-orange-500 to-amber-500' : 'bg-gradient-to-br from-gray-400 to-gray-500'">
                        {{-- Dot pattern --}}
                        <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle,#fff 1.5px,transparent 1.5px);background-size:20px 20px"></div>
                        {{-- Circles deco --}}
                        <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-white/10 rounded-full"></div>

                        <div class="relative p-7">
                            {{-- Store name --}}
                            <p class="text-white/70 text-xs font-semibold uppercase tracking-widest mb-1">{{ $commerce->name }}</p>

                            {{-- Code --}}
                            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur rounded-xl px-4 py-2 mb-5">
                                <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <span class="text-white font-black text-lg tracking-widest font-mono" x-text="preview"></span>
                            </div>

                            {{-- Discount --}}
                            <p class="text-white font-black text-4xl leading-none mb-1" x-text="discountLabel"></p>
                            <p class="text-white/80 text-sm font-semibold">de descuento</p>

                            {{-- Divider --}}
                            <div class="border-t border-white/20 my-5"></div>

                            {{-- Details --}}
                            <div class="space-y-1.5">
                                <p class="text-white/80 text-xs flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-white/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    <span x-text="minLabel"></span>
                                </p>
                                <p class="text-white/80 text-xs flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-white/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span x-text="expiresLabel"></span>
                                </p>
                            </div>
                        </div>

                        {{-- Perforation edge --}}
                        <div class="flex">
                            <div class="w-5 h-5 rounded-full bg-gray-50 -ml-2.5 shrink-0"></div>
                            <div class="flex-1 border-t-2 border-dashed border-white/30 my-2.5 mx-1"></div>
                            <div class="w-5 h-5 rounded-full bg-gray-50 -mr-2.5 shrink-0"></div>
                        </div>

                        <div class="relative px-7 py-4 flex items-center justify-between">
                            <p class="text-white/60 text-xs">Cupón de descuento</p>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold"
                                  :class="status === 'activo' ? 'bg-white/20 text-white' : 'bg-white/10 text-white/60'">
                                <span class="w-1.5 h-1.5 rounded-full" :class="status === 'activo' ? 'bg-white animate-pulse' : 'bg-white/40'"></span>
                                <span x-text="status === 'activo' ? 'Activo' : 'Inactivo'"></span>
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Tip --}}
                <div class="bg-orange-50 border border-orange-100 rounded-2xl p-4 flex items-start gap-3">
                    <svg class="w-4 h-4 text-orange-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-xs text-orange-700 leading-relaxed">
                        El comprador ingresará el código al momento de hacer su pedido. El descuento se aplica solo sobre los productos de tu comercio.
                    </p>
                </div>

            </div>
        </div>

    </div>

    {{-- ══ ACCIONES ══ --}}
    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
        <a href="{{ route('comerciante.coupons.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Cancelar
        </a>
        <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ $isEdit ? 'Guardar cambios' : 'Crear cupón' }}
        </button>
    </div>

</div>
