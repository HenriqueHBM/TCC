<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposProduto extends Model
{
    use HasFactory;
    protected $table = 'tipos_produtos';

    public function produtos() {
        return $this->hasMany(Produto::class, 'id_tipos_produtos', 'id_tipos_produtos');
    }
}
