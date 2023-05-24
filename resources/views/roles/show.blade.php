@extends('layouts.app')

@section('title', __('Users') . ' - ' . __('Roles') . ' - ' . __('Show'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">
          {{ __('Users') }}
        </a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('roles.index') }}">
          {{ __('Roles') }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{ __('Show') }}
      </li>
    </ol>
  </nav>
</div>

<x-card-trash title="{{ __('Role') }}">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      {{ __('Name') . ' : ' . $role->name }}
    </li>
    <li class="list-group-item">
      {{ __('Description') . ' : ' . $role->description }}
    </li>
  </ul>
</x-card-trash>  

<x-btn-back route="roles.index" />

<x-modal-trash class="modal-sm">
  <form method="post" action="{{route('roles.destroy', $role->id)}}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
      <x-icon icon='trash' /> {{ __('Delete this record?') }}
    </button>
  </form>
</x-modal-trash>

@endsection
