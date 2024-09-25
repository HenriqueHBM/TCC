<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosCategoria extends Model
{
    use HasFactory;
    protected $table = 'produtos_categorias';
    public $primaryKey = 'id_categoria';
    public $timestamps = false;
    public function produtos() {
        return $this->hasMany(Produto::class, 'id_categoria', 'id_categoria')->where('qtde', '>', 0);
    }
}
