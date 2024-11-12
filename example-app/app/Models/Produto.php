<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'produtos';
    public $primaryKey = "id_produto";
    public $timestamps = true;
    // atributos alterado para formato de data
    protected $dates = ['data_vencimento'];

    protected $fillable = [
        'id_produto'
    ];

    public function imagens() {
        return $this->hasMany(ProdutosImagem::class, 'id_produto', 'id_produto');
    }

    public function tipo_produto(){
        return $this->belongsTo(ProdutosCategoria::class, 'id_categoria', 'id_categoria');
    }

    public function vendedor(){
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id')->withDefault();
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }

    public function prod_eventos(){
        return $this->hasMany(ProdutosEvento::class, 'id_produto', 'id_produto');
    }
}
