<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Usuarios as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'mysql';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'telefone',
        'password',
        'email',
        'cpf',
        'data_cadastro',
    ];


    public function endereco(){
        return $this->belongsTo(Endereco::class, 'id_endereco', 'id_endereco');
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
}
