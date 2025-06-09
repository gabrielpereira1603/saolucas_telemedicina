@props([
    'width'  => '',
    'height' => '',
])

<img
    src="{{ asset('logo_transparent.png') }}"
    alt="Logo"
    {{ $attributes->merge([
        'width'  => $width,
        'height' => $height,
    ]) }}
>
