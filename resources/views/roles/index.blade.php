@extends('layouts.app')

@section('title', __('Users') . ' - ' . __('Roles'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        <a href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
      </li>
    </ol>
  </nav>

  <x-flash-message status='success'  message='message' />


  <x-btn-group label='MenuPrincipal' class="py-1">

    @can('role-create')
    <a class="btn btn-primary" href="{{ route('roles.create') }}" role="button"><x-icon icon='file-earmark'/> {{ __('New') }}</a>  
    @endcan

    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalFilter"><x-icon icon='funnel'/> {{ __('Filters') }}</button>

    @can('role-export')
    <x-dropdown-menu title='Reports' icon='printer'>

      <li>
        <a class="dropdown-item" href="{{route('roles.export.xls', ['description' => request()->input('description'), 'name' => request()->input('name')])}}"><x-icon icon='file-earmark-spreadsheet-fill' /> {{ __('Export') . ' XLS' }}</a>
      </li>
      <li>
        <a class="dropdown-item" href="{{route('roles.export.csv', ['description' => request()->input('description'), 'name' => request()->input('name')])}}"><x-icon icon='file-earmark-spreadsheet-fill'/> {{ __('Export') . ' CSV' }}</a>
      </li>
      <li>
        <a class="dropdown-item" href="{{route('roles.export.pdf', ['description' => request()->input('description'), 'name' => request()->input('name')])}}"><x-icon icon='file-pdf-fill' /> {{ __('Export') . ' PDF' }}</a>
      </li>
    
    </x-dropdown-menu> 
    @endcan 

  </x-btn-group>

  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>{{ __('Name') }}</th>
              <th>{{ __('Description') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>
                  <x-btn-group label='Opções'>

                    @can('role-edit')
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm" role="button"><x-icon icon='pencil-square'/></a>
                    @endcan

                    @can('role-show')
                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm" role="button"><x-icon icon='eye'/></a>
                    @endcan

                  </x-btn-group>
                </td>
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>

  <x-pagination :query="$roles" />

</div>

<x-modal-filter class="modal-lg" :perpages="$perpages" icon='funnel' title='Filters'>

  <form method="GET" action="{{ route('roles.index') }}">
    
    <div class="mb-3">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ session()->get('role_name') }}">
    </div>
    
    <div class="mb-3">
      <label for="description" class="form-label">{{ __('Description') }}</label>
      <input type="text" class="form-control" id="description" name="description" value="{{ session()->get('role_description') }}">
    </div>
    
    <button type="submit" class="btn btn-primary btn-sm"><x-icon icon='search'/> {{ __('Search') }}</button>
    
    <a href="{{ route('roles.index', ['name' => '', 'description' => '']) }}" class="btn btn-secondary btn-sm" role="button"><x-icon icon='stars'/> {{ __('Reset') }}</a>

  </form>

</x-modal-filter>  

@endsection
@section('script-footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var perpage = document.getElementById('perpage');
    perpage.addEventListener('change', function() {
        perpage = this.options[this.selectedIndex].value;
        window.open("{{ route('roles.index') }}" + "?perpage=" + perpage,"_self");
    });
});
</script>
@endsection