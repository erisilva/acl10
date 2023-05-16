@extends('layouts.app')

@section('title', __('Users') . ' - ' . __('New'))

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{ __('New') }}
      </li>
    </ol>
  </nav>
</div>

<div class="container">
  <form method="POST" action="{{ route('users.store') }}">
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
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? '' }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>      
      <div class="col-md-6">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input type="password" class="form-control" name="password_confirmation">
      </div>
      <div class="col-12">
        <p class="text-center bg-primary text-white">{{ __('Roles') }}</p>  
      </div>
      @foreach($roles as $role)
        @php
          $checked = '';
          if(old('roles') ?? false){
            foreach (old('roles') as $key => $id) {
              if($id == $role->id){
                $checked = "checked";
              }
            }
          }
        @endphp
      <div class="col-md-4">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="roles[]" value="{{$role->id}}" {{$checked}}>
            <label class="form-check-label" for="roles">{{$role->description}}</label>
        </div>
      </div>
      @endforeach
      <div class="col-12">  
        <button type="submit" class="btn btn-primary"><x-icon icon='plus-circle' /> {{ __('Save') }}</button>
      </div>
    </div>
  </form>
</div>

<x-btn-back route="users.index" />
@endsection
