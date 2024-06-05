@props(['active', 'href'])

@php
    $classes = ($active ?? false)
        ? 'active'
        : '';
@endphp

<li class="nav-item">
    <a class="nav-link {{ $classes }}" aria-current="page" href="{{$href}}">
        {{ $slot }}
    </a>
</li>

<!-- <a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> -->