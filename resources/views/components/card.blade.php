@props([
  'title' => '', 
  'footer' => ''
  ])
<div class="container">
  <div class="card">
    <div class="card-header">
      {{ $title }}
    </div>
    <div class="card-body">
      {{ $slot }}
    </div>
    @if ($footer)
    <div class="card-footer text-right">
      {{ $footer }}
    </div>
    @endif
  </div>
</div>