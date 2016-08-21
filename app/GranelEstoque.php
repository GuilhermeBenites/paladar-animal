<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GranelEstoque extends Model
{
    protected $fillable = ['produto_id', 'quantidade', 'preco'];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
