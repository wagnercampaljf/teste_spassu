<?php

namespace Database\Seeders;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criando 10 autores
        Autor::factory(10)->create();

        // Criando 10 assuntos
        Assunto::factory(10)->create();

        // Criando 10 livros
        Livro::factory(10)->create()->each(function ($livro) {
            // Associando entre 1 e 3 autores aleatórios
            $autores = Autor::inRandomOrder()->limit(rand(1, 3))->pluck('CodAu');
            $livro->autores()->sync($autores);

            // Associando entre 1 e 3 assuntos aleatórios
            $assuntos = Assunto::inRandomOrder()->limit(rand(1, 3))->pluck('CodAs');
            $livro->assuntos()->sync($assuntos);
        });
    }
}
