@extends('layouts.app')

@section('title', __('Profile'))

@section('content')

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
        
            <x-flash-message status='danger'  message='error' />

            <x-flash-message status='success'  message='success' />

            <x-flash-error status='danger' field='password' />
            
            <div class="card">
                <div class="card-header">
                    {{ __('Profile') }}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>{{ __('Name') }} : </strong>{{ $user->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('Email Address') }} : </strong>{{ $user->email }}
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#changePassword"><i class="bi bi-shield-lock"></i> {{ __('Change Password') }}</a>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#changeTheme"><i class="bi bi-palette"></i> {{ __('Change Theme') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<x-modal id="changePassword" title="{{ __('Change Password') }}" label="changeUserPassword">
    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password">
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Confirm New Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>    
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-shield-lock"></i> {{ __('Change Password') }}
            </button>
        </div>
    </form>
</x-modal>

<x-modal id="changeTheme" class="modal-lg" title="{{ __('Change Theme') }}" label="changeUserTheme">
    <form method="POST" action="{{ route('profile.theme.update') }}">
        @csrf       
        <div class="mb-3">
            <label for="theme" class="form-label">{{ __('Choose a New Theme') }}</label>
            <select class="form-select {{ $errors->has('theme') ? ' is-invalid' : '' }}" name="theme" id="theme">
                <option value="{{ Auth::user()->theme->id }}" selected="true">&rarr; {{ Auth::user()->theme->name . " - " . Auth::user()->theme->description }}</option>
                @foreach($themes as $theme)
                <option value="{{ $theme->id }}">{{ $theme->name . " - " . $theme->description }}</option>
                @endforeach
            </select>
            @error('theme')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror      
        </div> 
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-palette"></i> {{ __('Change Theme') }}
            </button>
        </div>
    </form>
</x-modal>

@endsection