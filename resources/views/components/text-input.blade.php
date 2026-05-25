@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-900
                    placeholder-gray-400 transition-all duration-200
                    focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none
                    hover:border-gray-300
                    disabled:bg-gray-50 disabled:text-gray-500 disabled:cursor-not-allowed'
    ]) }}
>
