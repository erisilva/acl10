@extends('layouts.app')

@section('title', __('Reset Password'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="captcha_img" class="col-sm-4 col-form-label"></label>
                            <div class="col-md-6">
                                <div class="captcha_img">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        <span><x-icon icon='arrow-clockwise' /></span>
                                    </button>
                                </div>
                            </div>    
                        </div>
                        <div class="mb-3 row">
                            <label for="captcha" class="col-sm-4 col-form-label text-end">Captcha</label>

                            <div class="col-md-6">
                                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha"  autocomplete="captcha">
                                @error('captcha')
                                <div class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-footer')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var reloadButton = document.getElementById('reload');
        reloadButton.addEventListener('click', function() {
            location.reload();
            return false;
        });
    });
</script>
@endsection