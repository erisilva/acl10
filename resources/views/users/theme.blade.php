@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alteração de Tema do Sistema</div>
                <div class="card-body">
                    @if(Session::has('password_altered'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Info!</strong>  {{ session('theme_altered') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('users.themeupdate') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label for="theme_id" class="col-sm-4 col-form-label text-end">Escolha o tema</label>
                            <div class="col-md-6">
                                <select class="form-select {{ $errors->has('theme_id') ? ' is-invalid' : '' }}" name="theme_id" id="theme_id">
                                    <option value="{{Auth::user()->theme->id}}" selected="true">&rarr; {{ Auth::user()->theme->name . " - " . Auth::user()->theme->description }}</option>        
                                    @foreach($themes as $theme)
                                    <option value="{{$theme->id}}">{{ $theme->name . " - " . $theme->description }}</option>
                                    @endforeach
                                    </select>
                                    @if ($errors->has('theme_id'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('theme_id') }}
                                    </div>
                                    @endif
                            </div>        
                        </div> 
                        <div class="mb-3 row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-palette"></i> Trocar Tema
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
