<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'Autor';

    protected $primaryKey = 'CodAu';

    protected $fillable = ['Nome']; 

    // Relacionamento muitos-para-muitos com Assuntos
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'Livro_Autor', 'Autor_CodAu', 'Livro_CodLi');
    }
}
