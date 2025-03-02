<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Livro;
use App\Models\Autor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroAutorFactory extends Factory
{
    public function definition()
    {
        return [
            'Livro_CodLi' => Livro::inRandomOrder()->first()->CodLi ?? Livro::factory(),
            'Autor_CodAu' => Autor::inRandomOrder()->first()->CodAu ?? Autor::factory(),
        ];
    }
}
