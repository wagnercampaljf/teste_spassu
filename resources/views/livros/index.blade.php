{{-- resources/views/livros/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Livros</h1>
    <a href="{{ route('livros.create') }}" class="btn btn-primary">Adicionar Novo Livro</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Editora</th>
                <th>Edição</th>
                <th>Ano de Publicação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
            <tr>
                <td>{{ $livro->Titulo }}</td>
                <td>{{ $livro->Editora }}</td>
                <td>{{ $livro->Edicao }}</td>
                <td>{{ $livro->AnoPublicacao }}</td>
                <td>
                    <a href="{{ route('livros.show', $livro->CodLi) }}" class="btn btn-info">Visualizar</a>
                    <a href="{{ route('livros.edit', $livro->CodLi) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('livros.destroy', $livro->CodLi) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
