{{-- resources/views/assuntos/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4 border-3 rounded-3">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3 mb-4">Editar Assunto</h1>
        </div>
    </div>
    <form action="{{ route('assuntos.update', $assunto->CodAs) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Método HTTP necessário para atualizações no Laravel -->
        @include('assuntos.partials.form')  <!-- Incluindo o formulário parcial -->
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary mt-3 mb-3">Atualizar Assunto</button>
            </div>
        </div>
    </form>
</div>
@endsection
