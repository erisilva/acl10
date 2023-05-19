@props(['route'])
<div class="container py-4">
  <div class="float-sm-end">
    <a href="{{ route($route) }}" class="btn btn-secondary btn-lg" role="button">
       <x-icon icon='arrow-left-square' />
       {{ __('Back') }}
    </a>
  </div>      
</div>