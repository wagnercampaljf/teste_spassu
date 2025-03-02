{{-- resources/views/assuntos/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4 border-3 rounded-3">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3 mb-4">Adicionar Novo Assunto</h1>
        </div>
    </div>
    <form action="{{ route('assuntos.store') }}" method="POST">
        @csrf
        @include('assuntos.partials.form')
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary mt-3 mb-3">Salvar Assunto</button>
            </div>
        </div>
    </form>
</div>
@endsection