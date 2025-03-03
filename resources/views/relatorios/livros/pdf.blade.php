<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 4px; }
        th { background-color: #ddd; }
        .filtros { margin-bottom: 0px; padding: 0x; border: 0px; font-size: 10;}

        .row {text-align: center;}
        .titulo-dado {text-align: left;}
        .titulo-nome {text-align: right;}

        .texto {font-size: 9px; margin-top: 40px;}

        .table-filtro td {
            width: 50%; 
        }

        .tr-destaque {
            margin: 15px;
            padding: 10px;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row">
        <h2>Relatório de Livros</h2>
    </div>
    
    <div class="row">
        <div class="filtros">
            <table class="table-filtro">
                <thead>
                    <tr>
                        <th colspan="2"><strong>Filtros Aplicados</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="titulo-nome"><strong>Título:</strong></td><td class="titulo-dado"> {{ $filtros['Titulo'] }}</td></tr>
                    <tr><td class="titulo-nome"><strong>Editora:</strong></td><td class="titulo-dado"> {{ $filtros['Editora'] }}</td></tr>
                    <tr><td class="titulo-nome"><strong>Autores:</strong></td><td class="titulo-dado"> {{ $filtros['Autores'] }}</td></tr>
                    <tr><td class="titulo-nome"><strong>Assuntos:</strong></td><td class="titulo-dado"> {{ $filtros['Assuntos'] }}</td></tr>
                    <tr><td class="titulo-nome"><strong>Ano de Publicação:</strong></td><td class="titulo-dado"> {{ $filtros['AnodePublicação'] }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="texto">
        <thead>
            <tr>
                <th>Título</th>
                <th>Editora</th>
                <th>Ano de Publicação</th>
                <th>Autor(es)</th>
                <th>Assunto(s)</th>
            </tr>
        </thead>
        <tbody>

            @php
                $autor_atual = null;
            @endphp

            @foreach ($livros as $livro)
                @if ($autor_atual !== $livro->Nome) 
                    <!-- Exibir o nome do autor antes de listar seus livros -->
                    <tr class="tr-destaque"><td colspan="5"><strong>AUTOR: </strong>{{ $livro->Nome }} <hr></td></tr>
                    @php
                        $autor_atual = $livro->Nome;
                    @endphp
                @endif
                <tr>
                    <td>{{ $livro->Titulo }}</td>
                    <td>{{ $livro->Editora }}</td>
                    <td style="text-align:center;">{{ $livro->AnoPublicacao }}</td>
                    <td>{{ $livro->Autores }}</td>
                    <td>{{ $livro->Assuntos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
