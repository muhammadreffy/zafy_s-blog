@props([
    'route' => null,
    'label' => '',
])

<li>
    <a href="{{ route($route) }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
        <div
            class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-primary
                    {{ Route::is($route . '*') ? 'text-primary' : '' }}">
            {{ $slot }}
        </div>
        <span class="ms-3 {{ Route::is($route . '*') ? 'text-primary' : '' }}">{{ $label }}</span>
    </a>
</li>
