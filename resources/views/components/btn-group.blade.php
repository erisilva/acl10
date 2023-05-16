@props(['label'])
<div {{ $attributes->merge(['class' => 'btn-group']) }} role="group" aria-label="{{ $label }}">
  {{$slot}}
</div>