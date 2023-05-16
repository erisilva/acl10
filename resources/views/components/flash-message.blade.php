@props(['status', 'message'])
@if(Session::has($message))
  <div class="alert alert-{{ $status }} alert-dismissible fade show" role="alert">
    {{ session($message) }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif