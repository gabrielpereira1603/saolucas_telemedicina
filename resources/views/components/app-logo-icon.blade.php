@props([
    'width'  => '',
    'height' => '',
])

<img
    style="width: {{ $width }}px; height: {{ $height }}px;"

    src="{{ asset('logo_transparent.png') }}"
    alt="Logo"
    {{ $attributes->merge([
        'width'  => $width,
        'height' => $height,
    ]) }}
>
