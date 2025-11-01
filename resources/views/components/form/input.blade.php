@props([
    'type' => 'text',
    'value' => '',
    'name',
    'label' => false,
])

@if ($label)
    <label for="{{ $name }}" class="form-label mt-3">{{ $label }}</label>
@endif

<input
    style="direction: rtl;"
    id="{{ $name }}"
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) }}
>

@error($name)
    <div class="text-danger small mt-1">{{ $message }}</div>
@enderror
