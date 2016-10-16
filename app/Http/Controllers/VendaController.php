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

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::orderBy('nome','asc')->get();
        
        $itensVenda = ItemVenda::itensVendaSemFinalizar();

        $totalDeVendas = 0;

        foreach ($itensVenda as $item){
            $item->produto = Produto::find($item->produto_id);
            $item->granel = Granel::find($item->granel_id);

            $totalDeVendas += $item->total;
        }

        $graneis = Granel::all();

        return view('vendas.index', array('produtos' => $produtos, 'itensVenda' => $itensVenda, 'totalDeVendas' => $totalDeVendas, 'graneis' => $graneis));
    }

    public function addProduto(Request $novoItem){

        $novoItem = $novoItem->all();

        /**
         * Verifica Estoque
         */
        $estoque = Estoque::where('produto_id','=',$novoItem['produto_id'])->first();

        if($estoque == null){
            return redirect('/vendas')->withErrors(["estoque" => "Produto não encontrado em Estoque"]);
        }

        if($estoque->quantidade == 0 || $estoque->quantidade < $novoItem['quantidade']){
            return redirect('/vendas')->withErrors(["estoque" => "Produto com estoque insuficiente"]);
        }

        $produto = Produto::find($novoItem['produto_id']);

        $itemVenda = ItemVenda::where('produto_id','=',$novoItem['produto_id'])->where('venda_id','=',null)->first();

        if($itemVenda){
            $itemVenda->quantidade += $novoItem['quantidade'];
            $itemVenda->total = $itemVenda->precoUnidade * $itemVenda->quantidade;
            $itemVenda->save();

            return redirect('/vendas');
        }

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

            if($item->produto_id != null){
                $itemEmEstoque = Estoque::where('produto_id', $item->produto_id)->first();
            }
            else{
                $itemEmEstoque = GranelEstoque::where('granel_id', $item->granel_id)->first();
            }

            $itemEmEstoque->quantidade -= $item->quantidade;

            $itemEmEstoque->save();

            $item->save();

            // Cria a movimentação

            $movimentacao = new Movimentacao();

            $movimentacao->venda_id = $venda->id;
            $movimentacao->quantidade = $item->quantidade;
            $movimentacao->produto_id = $item->produto_id;
            $movimentacao->granel_id = $item->granel_id;
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

        /**
         * Verifica Estoque
         */
        $estoque = GranelEstoque::where('granel_id','=',$novoItem['granel_id'])->first();

        if($estoque == null){
            return redirect('/vendas')->withErrors(["estoque" => "Granel não encontrado em Estoque"]);
        }

        if($estoque->quantidade == 0 || $estoque->quantidade < $novoItem['quantidade']){
            return redirect('/vendas')->withErrors(["estoque" => "Granel com estoque insuficiente"]);
        }

        $granel = GranelEstoque::where('granel_id','=',$novoItem['granel_id'])->first();

        $itemVenda = ItemVenda::where('granel_id','=',$novoItem['granel_id'])->where('venda_id','=',null)->first();

        if($itemVenda){
            $itemVenda->quantidade += $novoItem['quantidade'];
            $itemVenda->total = ($itemVenda->precoUnidade/1000) * $itemVenda->quantidade;
            $itemVenda->save();

            return redirect('/vendas');
        }

        $precoEmGramas = $granel->preco/1000;
        $novoItem['precoUnidade'] = $granel->preco;
        $novoItem['total'] = $precoEmGramas * $novoItem['quantidade'];

        ItemVenda::create($novoItem);

        return redirect('/vendas');
    }

    public function vendasDoDia(){
        $inicio = date('Y-m-d'). " 00:00:00";

        $fim = date("Y-m-d") . " 23:59:59";

        $vendas = Venda::where('created_at', '>', $inicio)->where('created_at', '<', $fim)->get();

        $vendas = $vendas->all();

        $vendasItems = [];
        foreach ($vendas as $venda){
            $itens = ItemVenda::where('venda_id','=',$venda["id"])->get();

            $itens = $itens->all();

            foreach ($itens as $item){
                $vendasItems[$venda["id"]]["itens"][] = $item;
            }

            $vendasItems[$venda["id"]]["total"] = $venda["total"];

            $data = $venda["created_at"];

            $data = $data->toDateTimeString();

            $vendasItems[$venda["id"]]["dia"] = $data;

            $vendasItems[$venda["id"]]["id"] = $venda["id"];
        }

        $dia = date("Y-m-d");

        return view('vendas.vendasDia', array('vendasItems' => $vendasItems, 'dia' => $dia));
    }

    public function vendasDoDiaPesquisa(Request $request){


        $dia = $request->get('diaVenda');

        $dia = str_replace('/','-',$dia);

        $dia = date_format(date_create($dia), 'Y-m-d');

        $inicio = $dia . " 00:00:00";

        $fim = $dia . " 23:59:59";

        $vendas = Venda::where('created_at', '>', $inicio)->where('created_at', '<', $fim)->get();

        $vendas = $vendas->all();

        $vendasItems = [];
        foreach ($vendas as $venda){
            $itens = ItemVenda::where('venda_id','=',$venda["id"])->get();

            $itens = $itens->all();

            foreach ($itens as $item){
                $vendasItems[$venda["id"]]["itens"][] = $item;
            }

            $vendasItems[$venda["id"]]["total"] = $venda["total"];

            $data = $venda["created_at"];

            $data = $data->toDateTimeString();

            $vendasItems[$venda["id"]]["dia"] = $data;

            $vendasItems[$venda["id"]]["id"] = $venda["id"];
        }

        return view('vendas.vendasDia', array('vendasItems' => $vendasItems, 'dia' => $dia));
    }
}
