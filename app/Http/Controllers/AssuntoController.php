<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assunto;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AssuntoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $descricao = $request->input('Descricao');

            $query = Assunto::query();

            if ($descricao) {
                $query->where('Descricao', 'like', "%$descricao%");
            }

            $assuntos = $query->paginate(4);

            return view('assuntos.index', compact('assuntos'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar assuntos: {$e->getMessage()}");
            return back()->with('error', 'Erro ao buscar assuntos.');
        }
    }


    public function create()
    {
        return view('assuntos.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'Descricao'  => 'required|max:255',
        ]);

        try {
            $assunto = new Assunto($request->only('Descricao'));
            $assunto->save();

            return redirect()->route('assuntos.index')->with('success', 'Assunto adicionado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao salvar o assunto: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao adicionar o assunto.');
        }
    }


    public function show($CodAu)
    {
        try {
            $assunto = Assunto::findOrFail($CodAu);
            return view('assuntos.show', compact('assunto'));
        } catch (\Exception $e) {
            Log::error("Erro ao mostrar o assunto: {$e->getMessage()}");
            return back()->with('error', 'Assunto não encontrado.');
        }
    }


    public function edit($CodAu)
    {
        try {
            $assunto = Assunto::findOrFail($CodAu);
            return view('assuntos.edit', compact('assunto'));
        } catch (\Exception $e) {
            Log::error("Erro ao buscar o assunto para edição: {$e->getMessage()}");
            return back()->with('error', 'Assunto não encontrado.');
        }
    }


    public function update(Request $request, $CodAu)
    {
        $request->validate([
            'Descricao'        => 'required|max:255',
        ]);

        try {
            $assunto = Assunto::findOrFail($CodAu);
            $assunto->update($request->only('Descricao'));

            return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao atualizar o assunto: {$e->getMessage()}");
            return back()->withInput()->with('error', 'Erro ao atualizar o assunto.');
        }
    }


    public function destroy($CodAu)
    {
        try {
            $assunto = Assunto::findOrFail($CodAu);
            $assunto->delete();
            return redirect()->route('assuntos.index')->with('success', 'Assunto deletado com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao deletar o assunto: {$e->getMessage()}");
            return back()->with('error', 'Erro ao deletar o assunto.');
        }
    }
}
