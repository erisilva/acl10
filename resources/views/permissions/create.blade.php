@extends('layouts.app')

@section('title', __('Users') . ' - ' . __('Permissions') . ' - ' . __('New'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('permissions.index') }}">{{ __('Permissions') }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
      {{ __('New') }}
      </li>
    </ol>
  </nav>
</div>

<div class="container">
  <form method="POST" action="{{ route('permissions.store') }}">
    @csrf
    <div class="row g-3">
      <div class="col-md-6">
          <label for="name" class="form-label">{{ __('Name') }}</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? '' }}">
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror      
      </div>
      <div class="col-md-6">
          <label for="description" class="form-label">{{ __('Description') }}</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? '' }}">
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror       
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary"><x-icon icon='plus-circle' /> {{ __('Save') }}</button>  
      </div>
    </div>     
  </form>
</div>

<x-btn-back route="permissions.index" />
@endsection
