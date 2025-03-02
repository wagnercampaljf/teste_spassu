@extends('layouts.app')

@section('content')
<div class="container mt-4 border border-3 rounded-3 p-3">
    <h1 class="mb-4">Relatório de Livros</h1>
    
    <form method="GET" action="{{ route('relatorios.livros.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <label for="Titulo">Título</label>
                <input type="text" name="Titulo" class="form-control" placeholder="Título" value="{{ request('Titulo') }}">
            </div>
            <div class="col-md-2">
                <label for="Editora">Editora</label>
                <input type="text" name="Editora" class="form-control" placeholder="Editora" value="{{ request('Editora') }}">
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="select-autores">Autores</label>
                    <select name="Autores[]" class="form-control" id="select-autores" multiple>
                        <option value="">Selecione Autores...</option>
                        @foreach($autores as $autor)
                            <option value="{{ $autor->CodAu }}" {{ (isset($livro) && $livro->autores->pluck('CodAu')->contains($autor->CodAu)) ? 'selected' : '' }}>
                                {{ $autor->Nome }}
                            </option>
                        @endforeach
                    </select>
                    <script>
                        new TomSelect("#select-autores", {
                            create: true,
                            sortField: "text",
                            onInitialize: function() {
                                this.wrapper.style.padding = "0px"; // Aplica inline na div gerada
                            }
                        });
                    </script>
                    
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="Assuntos">Assuntos</label>
                    <select name="Assuntos[]" class="form-control" id="select-assuntos" multiple>
                        <option value="">Selecione Assuntos...</option>
                        @foreach($assuntos as $assunto)
                            <option value="{{ $assunto->CodAs }}" {{ (isset($livro) && $livro->assuntos->pluck('CodAs')->contains($autor->CodAs)) ? 'selected' : '' }}>
                                {{ $assunto->Descricao }}
                            </option>
                        @endforeach
                    </select>
                    <script>
                        new TomSelect("#select-assuntos", {
                            create: true,
                            sortField: "text",
                            onInitialize: function() {
                                this.wrapper.style.padding = "0px"; // Aplica inline na div gerada
                            }
                        });
                    </script>
                    
                </div>
            </div>
            <div class="col-md-2">
                <label for="AnoPublicacaoInicial">Ano Inicial</label>
                <input type="number" name="AnoPublicacaoInicial" class="form-control" placeholder="Ano Inicial" value="{{ request('AnoPublicacaoInicial') }}">
            </div>
            <div class="col-md-2">
                <label for="AnoPublicacaoFinal">Ano Final</label>
                <input type="number" name="AnoPublicacaoFinal" class="form-control" placeholder="Ano Final" value="{{ request('AnoPublicacaoFinal') }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-end">
                @if(request()->has('Titulo') || request()->has('Editora') || request()->has('AnoPublicacaoInicial') || request()->has('AnoPublicacaoFinal') || request()->has('Autores') || request()->has('Assuntos'))
                    <a href="{{ route('relatorios.livros.index') }}" class="btn btn-secondary me-2"><i class="bi bi-x-circle"></i></a>
                @endif
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i>
                </button>
                <a href="{{ route('relatorios.livros.pdf', request()->query()) }}" class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
            </div>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Editora</th>
                <th>Ano</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($livros as $livro)
                <tr>
                    <td>{{ $livro->Titulo }}</td>
                    <td>{{ $livro->Editora }}</td>
                    <td>{{ $livro->AnoPublicacao }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nenhum livro encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $livros->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
