<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemVenda extends Model
{
    protected $table = 'item_venda';

    protected $fillable = ['produto_id', 'quantidade', 'precoUnidade', 'total'];

    public static function itensVendaSemFinalizar(){
        return DB::table('item_venda')->where('venda_id', null)->get();
    }

    public static function cancelaVenda(){
        DB::table('item_venda')->where('venda_id', null)->delete();
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
