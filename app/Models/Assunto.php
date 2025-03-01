<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $table = 'Assunto';

    protected $primaryKey = 'CodAs';

    protected $fillable = ['Descricao']; 

    // Relacionamento muitos-para-muitos com Assuntos
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'Livro_Assunto', 'CodAs', 'CodLi');
    }
}
