<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Type\Integer;

class LivroController extends Controller
{
    public function index()
    {
        try {
            $livros = Livro::all();
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


    public function store(Request $request)
    {
        $request->validate([
            'Titulo'        => 'required|max:255',
            'Editora'       => 'required|integer',
            'Edicao'        => 'required|integer',
            'AnoPublicacao' => 'required|integer',
            'Autores'       => 'required|array', 
            'Autores.*'     => 'exists:Autor,CodAu', 
            'Assuntos'      => 'required|array', 
            'Assuntos.*'    => 'exists:Assunto,CodAs'
        ]);

        try {
            $livro = new Livro($request->only('Titulo', 'Editora', 'Edicao', 'AnoPublicacao'));
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


    public function show(Integer $CodLi)
    {
        try {
            $livro = Livro::findOrFail($CodLi);
            return view('livros.show', compact('livro'));
        } catch (\Exception $e) {
            Log::error("Erro ao mostrar o livro: {$e->getMessage()}");
            return back()->with('error', 'Livro não encontrado.');
        }
    }


    public function edit(Integer $CodLi)
    {
        try {
            $livro = Livro::findOrFail($CodLi);
            $autores = Autor::all(); 
            $assuntos = Assunto::all(); 
            return view('livros.edit', compact('livro', 'autores', 'assuntos'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar o livro para edição: {$e->getMessage()}");
            return back()->with('error', 'Livro não encontrado.');
        }
    }


    public function update(Request $request, string $CodLi)
    {
        $request->validate([
            'Titulo'        => 'required|max:255',
            'Editora'       => 'required|integer',
            'Edicao'        => 'required|integer',
            'AnoPublicacao' => 'required|integer',
            'Autores'       => 'required|array', 
            'Autores.*'     => 'exists:Autor,CodAu', 
            'Assuntos'      => 'required|array', 
            'Assuntos.*'    => 'exists:Assunto,CodAs'
        ]);

        try {
            $livro = Livro::findOrFail($CodLi);
            $livro->update($request->only('Titulo', 'Editora', 'Edicao', 'AnoPublicacao'));

            // Atualizando relações
            $livro->autores()->sync($request->Autores);
            $livro->assuntos()->sync($request->Assuntos);

            return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar o livro: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao atualizar o livro.');
        }
    }


    public function destroy(Integer $CodLi)
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
}
