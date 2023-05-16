@extends('layouts.app')

@section('title', __('Users') . ' - ' . __('Roles') . ' - ' . __('New'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{ __('New') }}
      </li>
    </ol>
  </nav>
</div>

<div class="container">
  <form method="POST" action="{{ route('roles.store') }}">
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
        <p class="text-center bg-primary text-white">{{ __('Permissions') }}</p>  
      </div>
      @foreach($permissions as $permission)
        @php
          $checked = '';
          if(old('permissions') ?? false){
            foreach (old('permissions') as $key => $id) {
              if($id == $permission->id){
                $checked = "checked";
              }
            }
          }
        @endphp
      <div class="col-md-4">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->id}}" {{$checked}}>
            <label class="form-check-label" for="permissions">{{$permission->description}}</label>
        </div>
      </div>
      @endforeach
      <div class="col-12">  
        <button type="submit" class="btn btn-primary"><x-icon icon='plus-circle' /> {{ __('Save') }}</button>
      </div>
    </div>
  </form>
</div>

<x-btn-back route="roles.index" />
@endsection
