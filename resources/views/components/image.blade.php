
@if(!is_null($attributes['src']))
<img {{$attributes->merge(['class' => 'inline-flex items-center'])}}>
@else
    -
@endif