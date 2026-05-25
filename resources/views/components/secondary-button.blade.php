<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold
                text-gray-700 bg-white border-2 border-gray-200
                hover:border-orange-200 hover:text-orange-600 hover:bg-orange-50
                focus:outline-none focus:ring-4 focus:ring-orange-100
                transition-all duration-200
                disabled:opacity-60 disabled:cursor-not-allowed'
]) }}>
    {{ $slot }}
</button>
