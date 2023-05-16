@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')

<div class="container">

    <x-flash-message status='success'  message='register_user' />

    <x-flash-message status='success'  message='status' />


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
