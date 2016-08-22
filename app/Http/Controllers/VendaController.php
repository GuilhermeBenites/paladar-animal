<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Granel;
use App\GranelEstoque;
use App\ItemVenda;
use App\Movimentacao;
use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $item->granel = Granel::find($item->granel_id);

            $totalDeVendas += $item->precoUnidade * $item->quantidade;
        }

        $graneis = Granel::all();

        return view('vendas.index', array('produtos' => $produtos, 'itensVenda' => $itensVenda, 'totalDeVendas' => $totalDeVendas, 'graneis' => $graneis));
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

        $items = ItemVenda::where('venda_id', null)->get();

        foreach ($items as $item){
            $item->venda_id = $venda->id;

            $itemEmEstoque = Estoque::where('produto_id', $item->produto_id)->first();

            $itemEmEstoque->quantidade -= $item->quantidade;

            $itemEmEstoque->save();

            $item->save();

            // Cria a movimentação

            $movimentacao = new Movimentacao();

            $movimentacao->venda_id = $venda->id;
            $movimentacao->quantidade = $item->quantidade;
            $movimentacao->produto_id = $item->produto_id;
            $movimentacao->razao = 'venda';

            $movimentacao->usuario_id =  Auth::user()->id;

            $movimentacao->save();
        }

        return redirect('/vendas');
    }

    public function removeItem(ItemVenda $item){
        ItemVenda::destroy($item->id);

        return redirect('/vendas');
    }

    public function cancelaVenda(){
        ItemVenda::cancelaVenda();

        return redirect('/vendas');
    }

    public function addGRanel(Request $request){

        $novoItem = $request->all();

        $granel = GranelEstoque::where('granel_id','=',$novoItem['granel_id'])->first();

        $precoEmGramas = $granel->preco/1000;
        $novoItem['precoUnidade'] = $granel->preco;
        $novoItem['total'] = $precoEmGramas * $novoItem['quantidade'];

        ItemVenda::create($novoItem);

        return redirect('/vendas');
    }
}
