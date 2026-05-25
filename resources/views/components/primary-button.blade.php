<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white
                bg-gradient-to-r from-orange-500 to-orange-600
                hover:from-orange-600 hover:to-orange-700 active:scale-[0.97]
                shadow-lg shadow-orange-500/25 hover:shadow-xl hover:shadow-orange-500/30
                focus:outline-none focus:ring-4 focus:ring-orange-500/30
                transition-all duration-200
                disabled:opacity-60 disabled:cursor-not-allowed disabled:active:scale-100'
]) }}>
    {{ $slot }}
</button>
