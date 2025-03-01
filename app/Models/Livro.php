<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'Livro';

    protected $primaryKey = 'CodLi';

    protected $fillable = ['Titulo', 'Editora', 'Edicao', 'AnoPublicacao']; 

    // Relacionamento muitos-para-muitos com Autores
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor');
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'CodLi', 'CodAu');
    }

    // Relacionamento muitos-para-muitos com Assuntos
    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'CodLi', 'CodAs');
    }
}
