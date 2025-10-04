@extends('adminlte::page')

@section('title', 'Add novo Autor')

@section('content_header')
    <h1>Autores</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Cadastro de Autor</h3>
                </div>

                <form method="post" action="/authors/{{ $author->id }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nome do Autor</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $author->name) }}" placeholder="Nome do Autor">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop