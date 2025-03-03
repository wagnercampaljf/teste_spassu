<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class DashboardController extends Controller
{
    public function index(Request $request){
        $livros = Livro::select('Titulo', 'AnoPublicacao')->get();

        $dadosGrafico = Livro::selectRaw('AnoPublicacao, COUNT(*) as Total')
            ->groupBy('AnoPublicacao')
            ->orderBy('AnoPublicacao', 'asc')
            ->get();

        return view('dashboard', compact('livros', 'dadosGrafico'));
    }
}
