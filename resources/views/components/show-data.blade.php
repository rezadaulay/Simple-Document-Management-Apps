<p {!! $attributes->merge() !!}>
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        -
    @endif
</p>