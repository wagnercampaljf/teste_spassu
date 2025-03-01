<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'Autor';

    protected $primaryKey = 'CodAu';

    protected $fillable = ['Nome']; 

    // Relacionamento muitos-para-muitos com Assuntos
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'Livro_Autor', 'CodAu', 'CodLi');
    }
}
