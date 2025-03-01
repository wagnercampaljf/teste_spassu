{{-- resources/views/livros/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Novo Livro</h1>
    <form action="{{ route('livros.store') }}" method="POST">
        @csrf
        @include('livros.partials.form')
        <button type="submit" class="btn btn-primary">Salvar Livro</button>
    </form>
</div>
@endsection