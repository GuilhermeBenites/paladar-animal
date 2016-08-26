<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['produto_id', 'quantidade', 'categoria_id'];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }

    public function categoria(){
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }
}
