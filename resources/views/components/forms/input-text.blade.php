@props([
    'id' => null,
    'name' => null,
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'description' => null,
    'nameError' => null,
    'value' => null,
])

<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-secondary">
        {{ $label }}
    </label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        class="bg-gray-50 border border-gray-300 text-secondary text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}">

    <p class="mt-1 text-xs text-gray-500">
        {{ $description }}
    </p>

    <p class="mt-2 text-xs text-red-600">
        @error($name)
            {{ $message }}
        @enderror
    </p>
</div>
