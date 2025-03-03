<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Captura os filtros da requisição
            $titulo = $request->input('Titulo');
            $editora = $request->input('Editora');
            $anoPublicacao = $request->input('AnoPublicacao');

            // Query base
            $query = Livro::query();

            // Aplica filtros dinamicamente
            if ($titulo) {
                $query->where('Titulo', 'like', "%$titulo%");
            }
            
            if ($editora) {
                $query->where('Editora', 'like', "%$editora%");
            }
            
            if ($anoPublicacao) {
                $query->where('AnoPublicacao', $anoPublicacao);
            }

            $livros = $query->paginate(4);

            $livros->getCollection()->transform(function ($livro) {
                $livro->Valor = $this->formatarParaMoeda($livro->Valor);
                return $livro;
            });

            return view('livros.index', compact('livros'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar livros: {$e->getMessage()}");
            return back()->with('error', 'Erro ao buscar livros.');
        }
    }


    public function create()
    {
        $autores = Autor::all(); 
        $assuntos = Assunto::all(); 
        return view('livros.create', compact('autores', 'assuntos'));
    }


    public function store(LivroRequest $request)
    {
        try {
            $livro = new Livro;
            $livro->Titulo = $request->Titulo;
            $livro->Editora = $request->Editora;
            $livro->Edicao = $request->Edicao;
            $livro->AnoPublicacao = $request->AnoPublicacao;
            $livro->Valor = $this->converterParaFloat($request->Valor);
            $livro->save();

            // Associando autores e assuntos ao livro
            $livro->autores()->sync($request->Autores);
            $livro->assuntos()->sync($request->Assuntos);
            
            return redirect()->route('livros.index')->with('success', 'Livro adicionado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao salvar o livro: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao adicionar o livro.');
        }
    }


    public function show($CodLi)
    {
        try {
            $livro = Livro::findOrFail($CodLi);
            return view('livros.show', compact('livro'));
        } catch (\Exception $e) {
            Log::error("Erro ao mostrar o livro: {$e->getMessage()}");
            return back()->with('error', 'Livro não encontrado.');
        }
    }


    public function edit($CodLi)
    {
        try {
            $livro = Livro::with(['autores', 'assuntos'])->findOrFail($CodLi);
            $livro->Valor = $this->formatarParaMoeda($livro->Valor);

            $autores = Autor::all(); 
            $assuntos = Assunto::all(); 
            
            return view('livros.edit', compact('livro', 'autores', 'assuntos'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar o livro para edição: {$e->getMessage()}");
            return back()->with('error', 'Livro não encontrado.');
        }
    }


    public function update(LivroRequest $request, string $CodLi)
    {
        try {
            $livro = Livro::findOrFail($CodLi);
            $livro->Titulo = $request->Titulo;
            $livro->Editora = $request->Editora;
            $livro->Edicao = $request->Edicao;
            $livro->AnoPublicacao = $request->AnoPublicacao;
            $livro->Valor = $this->converterParaFloat($request->Valor);
            $livro->save();

            // Atualizando relações
            $livro->autores()->sync($request->Autores);
            $livro->assuntos()->sync($request->Assuntos);

            return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar o livro: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao atualizar o livro.');
        }
    }


    public function destroy($CodLi)
    {
        try {
            $livro = Livro::findOrFail($CodLi);
            $livro->delete();
            return redirect()->route('livros.index')->with('success', 'Livro deletado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao deletar o livro: {$e->getMessage()}");
            return back()->with('error', 'Erro ao deletar o livro.');
        }
    }

    public function converterParaFloat($valor)
    {
        // Remove "R$" e espaços em branco
        $valor = str_replace(['R$', ' '], '', $valor);

        // Remove pontos de milhar e substitui a vírgula decimal por ponto
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);

        // Converte para float
        return (float) $valor;
    }

    public function formatarParaMoeda($valor)
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

}
