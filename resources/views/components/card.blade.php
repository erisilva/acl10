@props(['title'])
<div class="container">
  <div class="card">
    <div class="card-header">
      {{$title}}
    </div>
    <div class="card-body">
      {{$slot}}
    </div>
    <div class="card-footer text-right">
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalLixeira">
        <x-icon icon='trash' /> {{ __('Delete this record?') }}
      </button>    
    </div>
  </div>  
</div>