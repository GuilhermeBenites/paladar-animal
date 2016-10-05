<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Estoque;
use App\InformarEstoque;
use App\Movimentacao;
use App\Produto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        $estoques = [];

        foreach ($categorias as $categoria){
            $estoque = Estoque::where('categoria_id','=', $categoria->id)->get();
            $estoques[$categoria->nome] = $estoque;
        }

        return view('estoque.index', array('estoques' => $estoques, 'categorias' => $categorias));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();

        return view('estoque.create', array('produtos' => $produtos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $itemEmEstoque = Estoque::where('produto_id', $request->get('produto_id'))->first();

        if($itemEmEstoque != null){
            $itemEmEstoque->quantidade += $request->get('quantidade');

            $itemEmEstoque->save();

            $request = $request->all();
        }
        else{

            $produto = Produto::find($request->get('produto_id'));

            $request = $request->all();

            $request['categoria_id'] = $produto->categoria_id;

            $itemEmEstoque = Estoque::create($request);
        }

        // Cria a movimentação

        $movimentacao = new Movimentacao();

        $movimentacao->quantidade = $request['quantidade'];
        $movimentacao->produto_id = $itemEmEstoque->produto_id;
        $movimentacao->razao = 'entrada';

        $movimentacao->usuario_id =  Auth::user()->id;

        $movimentacao->save();

        return redirect('/estoque');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function informar(){
        $produto = Produto::all();

        return view('estoque.informar', array('produtos' => $produto));
    }

    public function atualizar(Request $request){

        $request = $request->all();

        $itemEstoque = Estoque::where('produto_id','=',$request["produto_id"])->first();

        if($itemEstoque){
            $itemEstoque->quantidade = $request["quantidade"];

            $itemEstoque->save();

            $informarEstoque = new InformarEstoque();

            $informarEstoque->produto_id = $request["produto_id"];
            $informarEstoque->quantidade = $request["quantidade"];
            $informarEstoque->justificativa = $request["justificativa"];

            $informarEstoque->save();
        }

        return redirect('/estoque');
    }
}
