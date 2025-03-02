{{-- resources/views/assuntos/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4 border border-3 rounded-3 p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Assuntos</h1>
        <a href="{{ route('assuntos.create') }}" class="btn btn-primary mt-3">
            <i class="bi bi-plus-circle"></i> Adicionar Autor
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th class="w-auto text-center">Descrição</th> <!-- Coluna Descricao se ajusta automaticamente -->
                    <th class="text-center" style="width: 120px;">Ações</th> <!-- Coluna Ações com tamanho fixo -->
                </tr>
            </thead>
            <tbody>
                @foreach ($assuntos as $assunto)
                <tr>
                    <td class="w-auto">{{ $assunto->Descricao }}</td>
                    <td class="text-center" style="width: 120px; white-space: nowrap;">
                        <a href="{{ route('assuntos.edit', $assunto->CodAs) }}" class="btn btn-success btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('assuntos.destroy', $assunto->CodAs) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este assunto?');">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
