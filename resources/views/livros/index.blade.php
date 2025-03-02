{{-- resources/views/livros/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4 border border-3 rounded-3 p-3">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="mb-0">Livros</h1>
                <a href="{{ route('livros.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Adicionar Livro
                </a>
            </div>
        </div>
    </div>
    
    <form method="GET" action="{{ route('livros.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="Titulo" class="form-control" placeholder="Filtrar por título"
                value="{{ request('Titulo') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="Editora" class="form-control" placeholder="Filtrar por editora"
                value="{{ request('Editora') }}">
            </div>
            <div class="col-md-4">
                <input type="number" name="AnoPublicacao" class="form-control" placeholder="Ano de Publicação"
                value="{{ request('AnoPublicacao') }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-end">
                @if(request()->has('Titulo') || request()->has('Editora') || request()->has('AnoPublicacao'))
                    <a href="{{ route('livros.index') }}" class="btn btn-secondary me-2"><i class="bi bi-x-circle"></i></a>
                @endif
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </form>
    
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="w-auto text-center">Título</th>
                            <th class="w-auto text-center">Editora</th>
                            <th class="w-auto text-center">Edição</th>
                            <th class="w-auto text-center">Ano de Publicação</th>
                            <th class="w-auto text-center">Valor</th>
                            <th class="text-center" style="width: 120px;">Ações</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($livros as $livro)
                            <tr>
                                <td class="w-auto">{{ $livro->Titulo }}</td>
                                <td class="w-auto">{{ $livro->Editora }}</td>
                                <td class="w-auto text-end">{{ $livro->Edicao }}</td>
                                <td class="w-auto text-end">{{ $livro->AnoPublicacao }}</td>
                                <td class="w-auto text-end">{{ $livro->Valor }}</td>
                                <td class="text-center" style="width: 120px; white-space: nowrap;">
                                    <a href="{{ route('livros.edit', $livro->CodLi) }}" class="btn btn-success btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('livros.destroy', $livro->CodLi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este livro?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhum livro encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $livros->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
@endsection
