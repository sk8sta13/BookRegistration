@extends('adminlte::page')

@section('title', 'Lista de Assuntos')

@section('content_header')
    <h1>Assuntos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Assuntos</h3>
                    <div class="card-tools">
                        <form action="/subjects" method="get" class="form-inline">
                            <div class="input-group input-group-sm" style="width: 300px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="{{ request()->query('table_search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a class="btn btn-default" href="/subjects/create">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_asc" aria-controls="example1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Código</th>
                                        <th class="sorting" aria-controls="example1" aria-label="Browser: activate to sort column ascending">Assunto</th>
                                        <th class="sorting" aria-controls="example1" aria-label="Browser: activate to sort column ascending">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1">#{{ $subject->id }}</td>
                                            <td>{{ $subject->description }}</td>
                                            <td>
                                                <div class="input-group-append">
                                                    <a class="btn btn-default btn-xs" href="/subjects/{{ $subject->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-default btn-xs" href="/subjects/{{ $subject->id }}/edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                        class="btn btn-default btn-xs" 
                                                        data-toggle="modal" 
                                                        data-target="#confirmDeleteModal" 
                                                        data-route="/subjects/{{ $subject->id }}" 
                                                        data-name="{{ $subject->description }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Código</th>
                                        <th>Assunto</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
                            {{ $subjects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.deletion_confirmation')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop