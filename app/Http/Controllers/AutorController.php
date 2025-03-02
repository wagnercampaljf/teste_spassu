<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use Illuminate\Support\Facades\Log;

class AutorController extends Controller
{
    public function index()
    {
        try {
            $autores = Autor::all();
            return view('autores.index', compact('autores'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar autores: {$e->getMessage()}");
            return back()->with('error', 'Erro ao buscar autores.');
        }
    }


    public function create()
    {
        return view('autores.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'Nome'  => 'required|max:255',
        ]);

        try {
            $autor = new Autor($request->only('Nome'));
            $autor->save();

            return redirect()->route('autores.index')->with('success', 'Autor adicionado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao salvar o autor: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao adicionar o autor.');
        }
    }


    public function show($CodAu)
    {
        try {
            $autor = Autor::findOrFail($CodAu);
            return view('autores.show', compact('autor'));
        } catch (\Exception $e) {
            Log::error("Erro ao mostrar o autor: {$e->getMessage()}");
            return back()->with('error', 'Autor não encontrado.');
        }
    }


    public function edit($CodAu)
    {
        try {
            $autor = Autor::findOrFail($CodAu);
            return view('autores.edit', compact('autor'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar o autor para edição: {$e->getMessage()}");
            return back()->with('error', 'Autor não encontrado.');
        }
    }


    public function update(Request $request, $CodAu)
    {
        $request->validate([
            'Nome'        => 'required|max:255',
        ]);

        try {
            $autor = Autor::findOrFail($CodAu);
            $autor->update($request->only('Nome'));

            return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar o autor: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao atualizar o autor.');
        }
    }


    public function destroy($CodAu)
    {
        try {
            $autor = Autor::findOrFail($CodAu);
            $autor->delete();
            return redirect()->route('autores.index')->with('success', 'Autor deletado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao deletar o autor: {$e->getMessage()}");
            return back()->with('error', 'Erro ao deletar o autor.');
        }
    }
}
