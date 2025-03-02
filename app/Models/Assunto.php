<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assunto extends Model
{
    use HasFactory;
    
    protected $table = 'Assunto';

    protected $primaryKey = 'CodAs';

    protected $fillable = ['Descricao']; 

    // Relacionamento muitos-para-muitos com Assuntos
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'Livro_Assunto', 'Assunto_CodAs', 'Livro_CodLi');
    }
}
