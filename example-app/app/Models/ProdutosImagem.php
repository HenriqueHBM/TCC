<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutosImagem extends Model
{
    use HasFactory;
    protected $table = 'produtos_imagens';
    public $primaryKey = "id_imagem";
    
    public $timestamps = false;
}
