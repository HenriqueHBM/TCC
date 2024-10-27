<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $primaryKey = 'id_compra';

    public function pagamento(){
        return $this->belongsTo(Pagamento::class, 'id_pagamento', 'id_pagamento');
    }
}
