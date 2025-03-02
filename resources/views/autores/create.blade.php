{{-- resources/views/autores/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4 border-3 rounded-3">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-3 mb-4">Adicionar Novo Autor</h1>
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
    <form action="{{ route('autores.store') }}" method="POST">
        @csrf
        @include('autores.partials.form')
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary mt-3 mb-3">Salvar Autor</button>
            </div>
        </div>
    </form>
</div>
@endsection