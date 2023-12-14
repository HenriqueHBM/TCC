<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    public function ceps(){
        return $this->belongsTo(Cep::class, 'id_cep', 'id_cep');
    }
}
