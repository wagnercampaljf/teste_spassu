<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livro extends Model
{
    use HasFactory;
    
    protected $table = 'Livro';

    protected $primaryKey = 'CodLi';

    protected $fillable = ['Titulo', 'Editora', 'Edicao', 'AnoPublicacao', 'Valor']; 

    // Relacionamento muitos-para-muitos com Autores
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_CodLi', 'Autor_CodAu');
    }

    // Relacionamento muitos-para-muitos com Assuntos
    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_CodLi', 'Assunto_CodAs');
    }
}
