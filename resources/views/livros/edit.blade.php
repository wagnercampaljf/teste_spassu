{{-- resources/views/livros/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Editar Livro</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <form action="{{ route('livros.update', $livro->CodLi) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Método HTTP necessário para atualizações no Laravel -->
        @include('livros.partials.form')  <!-- Incluindo o formulário parcial -->
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Atualizar Livro</button>
            </div>
        </div>
    </form>
</div>
@endsection
