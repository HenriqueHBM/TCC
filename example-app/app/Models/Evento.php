<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    public $primaryKey = 'id_evento';

    public function endereco(){
        return $this->belongsTo(Endereco::class,"id_endereco","id_endereco");
    }
}
