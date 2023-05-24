@extends('layouts.app')

@section('title', __('Logs'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <a href="{{ route('logs.index') }}">{{ __('Logs') }}</a>
      </li>
    </ol>
  </nav>

  <x-flash-message status='success'  message='message' />

  <x-btn-group label='MenuPrincipal' class="py-1">
     
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalFilter"><x-icon icon='funnel'/> {{ __('Filters') }}</button>

  </x-btn-group>
  
  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>
                    {{ __('Date') }}
                </th>
                <th>
                    {{ __('Hour') }}
                </th>
                <th>
                    {{ __('When') }}
                </th>
                <th>
                    {{ __('User') }}
                </th>
                <th>
                    {{ __('Model') }}
                </th>
                <th>
                    {{ __('Action') }}
                </th>
                <th>
                    {{ __('ID') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>
                    {{ $log->id }}
                </td>
                <td>
                    {{ $log->created_at->format('d/m/Y') }}
                </td>
                <td>
                    {{ $log->created_at->format('H:i:s') }}
                </td>
                <td>
                    {{ $log->created_at->diffForHumans() }}
                </td>
                <td>
                    {{ $log->user->name }}
                </td>
                <td>
                    {{ $log->model }}
                </td>
                <td>
                    {{ $log->action }}
                </td>
                <td>
                    {{ $log->id }}
                </td>
                <td>
                  <x-btn-group label='Opções'>

                    <a href="{{route('logs.show', $log->id)}}" class="btn btn-info btn-sm" role="button"><x-icon icon='eye'/></a>

                  </x-btn-group>
                </td>
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>
  
  <x-pagination :query="$logs" />

</div>

<x-modal-filter class="modal-lg" :perpages="$perpages" icon='funnel' title='Filters' />

@endsection
@section('script-footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var perpage = document.getElementById('perpage');
    perpage.addEventListener('change', function() {
        perpage = this.options[this.selectedIndex].value;
        window.open("{{ route('logs.index') }}" + "?perpage=" + perpage,"_self");
    });
});
</script>
@endsection