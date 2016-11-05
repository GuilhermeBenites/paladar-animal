<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests\ProdutoRequest;
use App\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produtos.index')->with('produtos', Produto::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create')->with('categorias', Categoria::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProdutoRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $request = $request->all();
        $request['preco'] = str_replace(",","." , $request['preco']);

        Produto::create($request);

        return redirect('/produtos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Produto $produto
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Produto $produto)
    {
        return view('produtos.edit', ['produto' => $produto, 'categorias' => Categoria::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Produto $produto
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->fill($request->all());

        $produto->save();

        return redirect('/produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Produto $produto
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect('/produtos');
    }
}
