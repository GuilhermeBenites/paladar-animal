<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['codigo', 'nome', 'preco', 'categoria_id'];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
