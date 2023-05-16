@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alteração de Senha</div>
                <div class="card-body">
                    @if(Session::has('password_altered'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Info!</strong>  {{ session('password_altered') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(Session::has('password_wrong'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Info!</strong>  {{ session('password_wrong') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('users.passwordupdate') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label text-end">Senha Atual</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="newpassword" class="col-sm-4 col-form-label text-end">Nova Senha</label>
                            <div class="col-md-6">
                                <input id="newpassword" type="password" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" name="newpassword" required>
                                @if ($errors->has('newpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="newpassword_confirmation" class="col-sm-4 col-form-label text-end">Confirme a Nova Senha</label>
                            <div class="col-md-6">
                                <input id="newpassword_confirmation" type="password" class="form-control{{ $errors->has('newpassword_confirmation') ? ' is-invalid' : '' }}" name="newpassword_confirmation" required>
                                @if ($errors->has('newpassword_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newpassword_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   
                        <div class="mb-3 row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-key"></i> Trocar Senha
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
