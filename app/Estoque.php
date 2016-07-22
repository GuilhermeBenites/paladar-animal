<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['produto_id', 'quantidade'];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
