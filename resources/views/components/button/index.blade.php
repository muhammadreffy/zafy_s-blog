@props(['label' => null, 'class' => null])

<button type="submit"
    class="text-white {{ $class }} focus:outline-none focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 text-center transition-all duration-300 ease-in-out">
    {{ $label }}
</button>
