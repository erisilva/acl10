@extends('layouts.app')

@section('title', __('Users'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
      </li>
    </ol>
  </nav>

  <x-flash-message status='success'  message='message' />

  <x-btn-group label='MenuPrincipal' class="py-1">

    <a class="btn btn-primary" href="{{ route('users.create') }}" role="button"><x-icon icon='file-earmark'/> {{ __('New') }}</a>  

    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalFilter"><x-icon icon='funnel'/> {{ __('Filters') }}</button>

    <x-dropdown-menu title='Reports' icon='printer'>

      <li>
        <a class="dropdown-item" href="{{route('users.export.xls', ['email' => request()->input('email'), 'name' => request()->input('name')])}}"><x-icon icon='file-earmark-spreadsheet-fill' /> {{ __('Export') . ' XLS' }}</a>
      </li>
      <li>
        <a class="dropdown-item" href="{{route('users.export.csv', ['email' => request()->input('email'), 'name' => request()->input('name')])}}"><x-icon icon='file-earmark-spreadsheet-fill'/> {{ __('Export') . ' CSV' }}</a>
      </li>
      <li>
        <a class="dropdown-item" href="{{route('users.export.pdf', ['email' => request()->input('email'), 'name' => request()->input('name')])}}"><x-icon icon='file-pdf-fill' /> {{ __('Export') . ' PDF' }}</a>
      </li>
    
    </x-dropdown-menu>
    
    <x-dropdown-menu title='Options' icon='gear'>

      <li>
        <a class="dropdown-item" href="{{ route('roles.index') }}"><x-icon icon='table' /> {{ __('Roles') }}</a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('permissions.index') }}"><x-icon icon='table'/> {{ __('Permissions')}}</a>
      </li>
    
    </x-dropdown-menu>

  </x-btn-group>

  <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email Address') }}</th>
                <th>{{ __('Profiles') }}</th>
                <th>{{ __('Status') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-nowrap">{{ $user->name }}</td>
                <td class="text-nowrap">{{ $user->email }}</td>
                <td>
                  @foreach($user->roles as $role)
                    <span class="badge bg-primary text-dark">{{ $role->name }}</span>
                  @endforeach
                </td>
                <td>
                @if($user->active == 'n')
                <span class="badge bg-warning text-dark"><x-icon icon='lock'  /> {{ __('Inactive') }}</span>
                @endif
                </td>
                <td>
                  <x-btn-group label='Opções'>

                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm" role="button"><x-icon icon='pencil-square'/></a>

                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm" role="button"><x-icon icon='eye'/></a>

                  </x-btn-group>
                </td>
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>

  <x-pagination :query="$users" />

</div>

<x-modal-filter class="modal-lg" :perpages="$perpages" icon='funnel' title='Filters'>

  <form method="GET" action="{{ route('users.index') }}">
    
    <div class="mb-3">
      <label for="name" class="form-label">{{ __('Name') }}</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ session()->get('user_name') }}">
    </div>
    
    <div class="mb-3">
      <label for="email" class="form-label">{{ __('Email Address') }}</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ session()->get('user_description') }}">
    </div>
    
    <button type="submit" class="btn btn-primary btn-sm"><x-icon icon='search'/> {{ __('Search') }}</button>
    
    <a href="{{ route('users.index', ['name' => '', 'email' => '']) }}" class="btn btn-secondary btn-sm" role="button"><x-icon icon='stars'/> {{ __('Reset') }}</a>

  </form>

</x-modal-filter> 

@endsection
@section('script-footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var perpage = document.getElementById('perpage');
    perpage.addEventListener('change', function() {
        perpage = this.options[this.selectedIndex].value;
        window.open("{{ route('users.index') }}" + "?perpage=" + perpage,"_self");
    });
});
</script>
@endsection