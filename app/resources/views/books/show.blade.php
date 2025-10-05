@extends('adminlte::page')

@section('title', 'Detalhes do Livro')

@section('content_header')
    <h1>Livros</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Detalhes do Livro</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="title">Titulo:&nbsp;</label>
                        {{ $book->title }}
                    </div>

                    <div class="form-group">
                        <label for="title">Autor(es):&nbsp;</label>
                        {{ implode(', ', $book->authors->pluck('name')->toArray()) }}
                    </div>

                    <div class="form-group">
                        <label for="title">Assunto(s):&nbsp;</label>
                        {{ implode(', ', $book->subjects->pluck('description')->toArray()) }}
                    </div>

                    <div class="form-group">
                        <label for="publisher">Editora:&nbsp;</label>
                        {{ $book->publisher }}
                    </div>

                    <div class="form-group">
                        <label for="edition">Edição:&nbsp;</label>
                        {{ $book->edition }}
                    </div>

                    <div class="form-group">
                        <label for="publication_year">Ano de Publicação:&nbsp;</label>
                        {{ $book->publication_year }}
                    </div>

                    <div class="form-group">
                        <label for="price">Preço:&nbsp;</label>
                        {{ $book->price }}
                    </div>

                    <div class="form-group">
                        <label for="created_at">Data da criação:&nbsp;</label>
                        {{ $book->created_at->format('d/m/Y H:i:s') }}
                    </div>

                    <div class="form-group">
                        <label for="updated_at">Data da última atualização:&nbsp;</label>
                        {{ $book->updated_at->format('d/m/Y H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop