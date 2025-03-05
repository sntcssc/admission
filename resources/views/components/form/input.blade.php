@props(['name', 'label', 'type' => 'text', 'required' => false])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">
        {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
    </label>
    <input type="{{ $type }}" 
           id="{{ $name }}"
           name="{{ $name }}"
           {{ $required ? 'required' : '' }}
           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
           {{ $attributes }}>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>