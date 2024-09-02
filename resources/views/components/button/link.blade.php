@props([
    'route' => null,
    'label' => '',
    'params' => [],
])

<a href="{{ route($route, $params) }}"
    class="text-white bg-primary hover:bg-color_hover focus:outline-none focus:ring-4 focus:ring-primary font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
    {{ $label }}
</a>
