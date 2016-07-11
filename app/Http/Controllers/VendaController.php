<?php

namespace App\Http\Controllers;

use App\ItemVenda;
use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        
        $itensVenda = ItemVenda::itensVendaSemFinalizar();

        $totalDeVendas = 0;

        foreach ($itensVenda as $item){
            $item->produto = Produto::find($item->produto_id);

            $totalDeVendas += $item->produto->preco;
        }

        return view('vendas.index', array('produtos' => $produtos, 'itensVenda' => $itensVenda, 'totalDeVendas' => $totalDeVendas));
    }

    public function addProduto(Request $novoItem){

        $novoItem = $novoItem->all();
        $produto = Produto::find($novoItem['produto_id']);
        $novoItem['precoUnidade'] = $produto->preco;
        $novoItem['total'] = $produto->preco * $novoItem['quantidade'];
        
        ItemVenda::create($novoItem);
        
        return redirect('/vendas');
    }


    public function finalizar(Request $total){

        $venda = Venda::create($total->all());

        DB::table('item_vendas')
            ->where('venda_id', null)
            ->update(['venda_id' => $venda->id]);

        return redirect('/vendas');
    }
}
