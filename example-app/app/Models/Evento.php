<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $primaryKey = 'id_evento';


    public function endereco(){
        return $this->belongsTo(Endereco::class,"id_endereco","id_endereco");
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario','id');
    }

    public function produtos(){
        return $this->hasMany(ProdutosEvento::class, 'id_evento', 'id_evento');
    }
}
