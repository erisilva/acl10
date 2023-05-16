@props([
  'perpages' => null,
  'icon' => null,
  'title' => 'Modal'
  ])
<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="JanelaFiltro" aria-hidden="true">
  <div {{$attributes->merge(['class' => 'modal-dialog modal-dialog-centered'])}}>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleFilter">
          @isset($icon) <x-icon icon='{{$icon}}'/>  @endisset {{__($title)}}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       	{{$slot}}
        <div class="mb-3 py-3">
          <select class="form-select" aria-label="Selecione número de registros/página" name="perpage" id="perpage">
            @foreach($perpages as $perpage)
            <option value="{{$perpage->valor}}"  {{($perpage->valor == session('perPage')) ? 'selected' : ''}}>{{$perpage->nome}}</option>
            @endforeach
          </select>
        </div>
      </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><x-icon icon="x-square"/> {{ __('Close') }}</button>
      </div>
    </div>
  </div>
</div>