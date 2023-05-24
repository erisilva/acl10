@extends('layouts.app')

@section('title', __('Logs') . ' - ' . __('Show'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">
        <a href="{{ route('logs.index') }}">
          {{ __('Logs') }}
        </a>
      </li>
    </ol>
  </nav>
</div>

<x-card title="{{ __('Logs') }}">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
      {{ __('Id') . ' : ' . $log->id }}
    </li>
    <li class="list-group-item">
      {{ __('Date') . ' : ' . $log->created_at->format('d/m/Y') }}
    </li>
    <li class="list-group-item">
      {{ __('Hour') . ' : ' . $log->created_at->format('H:i:s') }}
    </li>
    <li class="list-group-item">
      {{ __('User') . ' : ' . $log->user->name }}
    </li>
    <li class="list-group-item">
      {{ __('Model') . ' : ' . $log->model }}
    </li>
    <li class="list-group-item">
      {{ __('Action') . ' : ' . $log->action }}
    </li>
    <li class="list-group-item">
      {{ __('Changes') . ' : ' . $log->changes }}
    </li>
  </ul>
</x-card>

<x-btn-back route="logs.index" />

@endsection
