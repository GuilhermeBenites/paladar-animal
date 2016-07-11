<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemVenda extends Model
{
    protected $fillable = ['produto_id', 'quantidade', 'precoUnidade', 'total'];

    public static function itensVendaSemFinalizar(){
        return DB::table('item_vendas')->where('venda_id', null)->get();
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
