<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformarEstoque extends Model
{
    protected $fillable = ['produto_id','granel_id','quantidade','justificativa'];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }

    public function granel()
    {
        return $this->belongsTo('App\Granel', 'granel_id');
    }
}
