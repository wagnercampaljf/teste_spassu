<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $titulo = $request->input('Titulo');
        $editora = $request->input('Editora');
        $autores = $request->input('Autores', []); // Array de IDs
        $assuntos = $request->input('Assuntos', []); // Array de IDs
        $anoInicial = $request->input('AnoPublicacaoInicial');
        $anoFinal = $request->input('AnoPublicacaoFinal');

        // Query base
        $query = Livro::query();

        // Aplica filtros condicionais
        if ($titulo) {
            $query->where('Titulo', 'like', "%$titulo%");
        }

        if ($editora) {
            $query->where('Editora', 'like', "%$editora%");
        }

        if (!empty($autores)) {
            $query->whereHas('autores', function ($q) use ($autores) {
                $q->whereIn('CodAu', $autores);
            });
        }

        if (!empty($assuntos)) {
            $query->whereHas('assuntos', function ($q) use ($assuntos) {
                $q->whereIn('CodAs', $assuntos);
            });
        }

        // Filtra por intervalo de anos
        if ($anoInicial && $anoFinal) {
            $query->whereBetween('AnoPublicacao', [$anoInicial, $anoFinal]);
        } elseif ($anoInicial) {
            $query->where('AnoPublicacao', '>=', $anoInicial);
        } elseif ($anoFinal) {
            $query->where('AnoPublicacao', '<=', $anoFinal);
        }

        // Obtém os livros filtrados paginados
        $livros = $query->paginate(5);

        $autores = Autor::all();
        $assuntos = Assunto::all();

        return view('relatorios.livros.index', compact('livros', 'autores', 'assuntos'));
    }

    public function gerarPDF(Request $request)
    {
        // Captura os filtros do usuário
        $titulo = $request->input('Titulo');
        $editora = $request->input('Editora');
        $autores = $request->input('Autores', []);
        $assuntos = $request->input('Assuntos', []);
        $anoInicial = $request->input('AnoPublicacaoInicial');
        $anoFinal = $request->input('AnoPublicacaoFinal');

        // Query base com filtros
        $query = Livro::query();

        if ($titulo) {
            $query->where('Titulo', 'like', "%$titulo%");
        }

        if ($editora) {
            $query->where('Editora', 'like', "%$editora%");
        }

        if (!empty($autores)) {
            $query->whereHas('autores', function ($q) use ($autores) {
                $q->whereIn('CodAu', $autores);
            });
        }

        if (!empty($assuntos)) {
            $query->whereHas('assuntos', function ($q) use ($assuntos) {
                $q->whereIn('CodAs', $assuntos);
            });
        }

        if ($anoInicial && $anoFinal) {
            $query->whereBetween('AnoPublicacao', [$anoInicial, $anoFinal]);
        } elseif ($anoInicial) {
            $query->where('AnoPublicacao', '>=', $anoInicial);
        } elseif ($anoFinal) {
            $query->where('AnoPublicacao', '<=', $anoFinal);
        }

        // Aplicar ordenação fixa: Autor → Assunto → Título → Ano de Publicação
        $query->with(['autores', 'assuntos'])
            ->leftJoin('Livro_Autor', 'Livro_Autor.Livro_CodLi', '=', 'Livro.CodLi')
            ->leftJoin('Autor', 'Autor.CodAu', '=', 'Livro_Autor.Autor_CodAu')
            ->leftJoin('Livro_Assunto', 'Livro_Assunto.Livro_CodLi', '=', 'Livro.CodLi')
            ->leftJoin('Assunto', 'Assunto.CodAs', '=', 'Livro_Assunto.Assunto_CodAs')
            ->select('Livro.*')
            ->orderBy('Autor.Nome', 'asc')
            ->orderBy('Livro.Titulo', 'asc')
            ->orderBy('Livro.AnoPublicacao', 'asc')
            ->distinct();

        // Buscar os livros filtrados
        $livros = $query->get();

        // Montar filtros para exibição no PDF
        $filtros = [
            'Titulo' => $titulo ?: 'Todos',
            'Editora' => $editora ?: 'Todos',
            'Autores' => empty($autores) ? 'Todos' : Autor::whereIn('CodAu', $autores)->pluck('Nome')->join(', '),
            'Assuntos' => empty($assuntos) ? 'Todos' : Assunto::whereIn('CodAs', $assuntos)->pluck('Descricao')->join(', '),
            'AnodePublicação' => ($anoInicial || $anoFinal) ? "{$anoInicial} - {$anoFinal}" : 'Todos',
        ];

        // Gera o PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('relatorios.livros.pdf', compact('livros', 'filtros'));

        // Retorna o PDF para abrir em uma nova aba
        return $pdf->stream('relatorio-livros.pdf');
    }


}
