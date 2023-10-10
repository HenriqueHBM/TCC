<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    public $timestamps = true;

    public function imagens() {
        return $this->hasMany(ProdutosImagem::class, 'id_produto', 'id_produto');
    }

    public function tipo_produto(){
        return $this->belongsTo(ProdutosCategoria::class, 'id_categoria', 'id_categoria');
    }
}
