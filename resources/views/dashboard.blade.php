@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h2>Dashboard</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">Livros por Ano</div>
                <div class="card-body">
                    <canvas id="grafico"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">Lista de Livros</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Ano de Publicação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($livros as $livro)
                            <tr>
                                <td>{{ $livro->Titulo }}</td>
                                <td>{{ $livro->AnoPublicacao }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('grafico').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dadosGrafico->pluck('AnoPublicacao')) !!},
            datasets: [{
                label: 'Quantidade de Livros',
                data: {!! json_encode($dadosGrafico->pluck('Total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
@endsection
