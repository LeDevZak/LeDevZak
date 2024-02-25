@props(['name'])

@error($name)
    <p class="text-yellow-500 text-xs mt-2">{{ $message }}</p>
@enderror
