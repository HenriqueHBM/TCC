<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosEvento extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey = "id_produto_evento";

    protected $fillable = [
        'id_produto'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto')->withTrashed();
    }
}
