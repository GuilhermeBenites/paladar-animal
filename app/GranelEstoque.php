<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GranelEstoque extends Model
{
    protected $fillable = ['granel_id', 'quantidade', 'preco'];

    public function granel()
    {
        return $this->belongsTo('App\Granel', 'granel_id');
    }
}
