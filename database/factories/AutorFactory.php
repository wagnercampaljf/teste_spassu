<?php

namespace Database\Factories;
use App\Models\Autor;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Autor>
 */
class AutorFactory extends Factory
{
    protected $model = Autor::class;

    public function definition()
    {
        return [
            'Nome' => $this->faker->name,
        ];
    }
}
