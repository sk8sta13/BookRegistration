@extends('adminlte::page')

@section('title', 'Edição de Livro')

@section('content_header')
    <h1>Livros</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Edição de Livro</h3>
                </div>

                <form method="post" action="/books/{{ $book->id }}">
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
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $book->title) }}" placeholder="Titulo">
                        </div>
                        <div class="form-group">
                            <label for="author_id">Autor</label>
                            <select class="form-control select2bs4" 
                                id="author_id" 
                                name="author_id[]" 
                                multiple="multiple" 
                                data-placeholder="Selecione um ou mais autores" 
                                style="width: 100%;">
                                @foreach ($authors as $id => $name)
                                    <option value="{{ $id }}" {{ (in_array($id, $book->authors->pluck('id')->toArray()) ? 'selected' : '') }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject_id">Assunto</label>
                            <select class="form-control select2bs4" 
                                id="subject_id" 
                                name="subject_id[]" 
                                multiple="multiple" 
                                data-placeholder="Selecione um ou mais assuntos" 
                                style="width: 100%;">
                                @foreach ($subjects as $id => $description)
                                    <option value="{{ $id }}" {{ (in_array($id, $book->subjects->pluck('id')->toArray()) ? 'selected' : '') }}>{{ $description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="publisher">Editora</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}" placeholder="Editora">
                        </div>
                        <div class="form-group">
                            <label for="edition">Edição</label>
                            <input type="text" class="form-control @error('edition') is-invalid @enderror" name="edition" id="edition" value="{{ old('edition', $book->edition) }}" placeholder="Edição">
                        </div>
                        <div class="form-group">
                            <label for="publication_year">Ano de Publicação</label>
                            <input type="text" class="form-control @error('publication_year') is-invalid @enderror" name="publication_year" id="publication_year" value="{{ old('publication_year', $book->publication_year) }}" placeholder="Ano">
                        </div>
                        <div class="form-group">
                            <label for="price">Preço</label>
                            <input type="text" inputmode="numeric" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price', $book->price) }}" data-mask="" placeholder="Preço">
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

@push('css')
    {{-- CSS do Select2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    {{-- CSS do Tema Bootstrap 4 (para a aparência do AdminLTE) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.1/dist/select2-bootstrap4.min.css">
@endpush

@push('js')
    {{-- JS do Select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    {{-- JS do InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

    {{-- Seu código de inicialização AGORA deve funcionar --}}
    <script>
        $(function () {
            $('#price').inputmask('numeric', {
                radixPoint: ".", 
                digits: 2,
                digitsOptional: false,
                allowMinus: false,
                autoGroup: true,
                clearMaskOnLostFocus: false
            });
            $('.select2bs4').select2({ theme: 'bootstrap4' });
            $('[data-mask]').inputmask();
        });
    </script>
@endpush