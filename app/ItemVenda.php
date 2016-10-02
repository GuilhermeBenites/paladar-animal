<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemVenda extends Model
{
    protected $table = 'item_venda';

    protected $fillable = ['produto_id', 'quantidade', 'precoUnidade', 'total', 'granel_id'];

    public static function itensVendaSemFinalizar(){
        return DB::table('item_venda')->where('venda_id', null)->orderBy('updated_at', 'desc')->get();
    }

    public static function cancelaVenda(){
        DB::table('item_venda')->where('venda_id', null)->delete();
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }

    public function granel()
    {
        return $this->belongsTo('App\Granel', 'granel_id');
    }
}
