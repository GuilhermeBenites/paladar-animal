<?php

namespace App\Http\Controllers;

use App\Estoque;
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
        $estoque = Estoque::all();

        return view('estoque.index', array('estoque' => $estoque));
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
            $itemEmEstoque->preco = $request->get('preco');

            $itemEmEstoque->save();
        }
        else{
            $itemEmEstoque = Estoque::create($request->all());
        }

        // Cria a movimentação

        $movimentacao = new Movimentacao();

        $movimentacao->quantidade = $request->get('quantidade');
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
}
