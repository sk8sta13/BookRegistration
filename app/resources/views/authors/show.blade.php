@extends('adminlte::page')

@section('title', 'Detalhes do Autor')

@section('content_header')
    <h1>Autores</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Detalhes do Autor</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                        <div class="form-group">
                            <label for="name">Nome do Autor:&nbsp;</label>
                            {{ $author->name }}
                        </div>

                        <div class="form-group">
                            <label for="name">Data da criação:&nbsp;</label>
                            {{ $author->created_at->format('d/m/Y H:i:s') }}
                        </div>

                        <div class="form-group">
                            <label for="name">Data da última atualização:&nbsp;</label>
                            {{ $author->updated_at->format('d/m/Y H:i:s') }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop