<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $fillable = ['venda_id', 'quantidade', 'produto_id', 'razao', 'granel_id'];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }

    public function granel(){
        return $this->belongsTo('App\Granel', 'granel_id');
    }
}
