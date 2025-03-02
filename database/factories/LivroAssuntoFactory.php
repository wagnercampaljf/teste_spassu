<?php

namespace Database\Factories;
use App\Models\Livro;
use App\Models\Assunto;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroAssuntoFactory extends Factory
{
    public function definition()
    {
        return [
            'Livro_CodLi' => Livro::inRandomOrder()->first()->CodLi ?? Livro::factory(),
            'Assunto_CodAs' => Assunto::inRandomOrder()->first()->CodAs ?? Assunto::factory(),
        ];
    }
}
