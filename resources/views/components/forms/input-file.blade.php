@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => null,
])

<div>
    <label class="block mb-2 text-sm font-medium text-secondary" for="{{ $name }}">
        {{ $label }}
    </label>
    <input
        class="block w-full text-sm border border-gray-300 rounded-lg cursor-pointer text-secondary bg-gray-50 focus:outline-none"
        id="{{ $id }}" name="{{ $name }}" type="file" value="{{ old($name, $value) }}">
    <p class="mt-1 text-xs text-gray-500">
        PNG, or JPG (MAX. 800x400px).
    </p>
    <p class="mt-2 text-xs text-red-600">
        @error($name)
            {{ $message }}
        @enderror
    </p>
</div>
