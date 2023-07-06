@extends('layouts.app')

@section('title', __('Users') . ' - ' . __('Show'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">
          {{ __('Users') }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{ __('Show') }}
      </li>
    </ol>
  </nav>
</div>

<x-card title="{{ __('User') }}">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      {{ __('Name') . ' : ' . $user->name }}
    </li>
    <li class="list-group-item">
      {{ __('Email Address') . ' : ' . $user->email }}
    </li>
    <li class="list-group-item">
      <strong>
        {{($user->active == 'y') ? __('Active') : __('Inactive')}}
      </strong>
    </li>
  </ul>
</x-card>

@can('user-delete')
<x-btn-trash />
@endcan

<x-btn-back route="users.index" />

<x-modal-trash class="modal-sm">
  <form method="post" action="{{route('users.destroy', $user->id)}}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
      <x-icon icon='trash' /> {{ __('Delete this record?') }}
    </button>
  </form>
</x-modal-trash>

@endsection
