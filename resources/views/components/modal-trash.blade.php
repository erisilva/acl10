<div class="modal fade" id="modalLixeira" tabindex="-1" aria-labelledby="JanelaLixeira" aria-hidden="true">
  <div {{$attributes->merge(['class' => 'modal-dialog modal-dialog-centered'])}} role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleLixeira">
          <i class="bi bi-patch-question"></i> {{ __('Confirm') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$slot}}
      </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
          <i class="bi bi-x-square"></i> {{ __('Cancel') }}
        </button>
      </div>
    </div>
  </div>
</div> 