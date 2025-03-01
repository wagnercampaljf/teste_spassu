{{-- resources/views/livros/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Livro</h1>
    <form action="{{ route('livros.update', $livro->CodLi) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Método HTTP necessário para atualizações no Laravel -->
        @include('livros.partials.form')  <!-- Incluindo o formulário parcial -->
        <button type="submit" class="btn btn-primary">Atualizar Livro</button>
    </form>
</div>
@endsection
