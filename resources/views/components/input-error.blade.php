@props(['for'])

@error($for)
    <span {{ $attributes->merge(['style' => 'font-size: 0.875rem; color: #dc2626;']) }}>
        {{ $message }}
    </span>
@enderror
