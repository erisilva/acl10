@props([
    'title' => 'Opções',
    'icon' => null
    ])
<div {{ $attributes->merge(['class' => 'btn-group']) }} role="group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        @isset($icon) <x-icon icon='{{$icon}}'/>  @endisset {{__($title)}}
    </button>
    <ul class="dropdown-menu">
       {{$slot}}
    </ul>
</div>