<?php

namespace App\Http\Controllers;

use App\Granel;
use App\GranelEstoque;
use App\InformarEstoque;
use App\Produto;
use Illuminate\Http\Request;

use App\Http\Requests;

class GranelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graneis = GranelEstoque::all();

        return view('granel.index', array('graneis' => $graneis));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('granel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        Granel::create($request);

        return redirect('/granel');
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

    public function abrirSacoForm(){

        $graneis = Granel::all();

        $racoes = Produto::where('categoria_id', '=', '1')->get();

        return view('granel.abrir', array('graneis' => $graneis, 'racoes' => $racoes));
    }

    public function abrirSacoSalvar(Request $request){

        $itemEmEstoque = GranelEstoque::where('granel_id', $request->get('granel_id'))->first();

        if($itemEmEstoque != null){
            $itemEmEstoque->quantidade += $request->get('quantidade');

            $preco = str_replace(",","." , $request->get('preco'));
            $itemEmEstoque->preco = $preco;

            $itemEmEstoque->save();
        }
        else{
            $itemEmEstoque = GranelEstoque::create($request->all());
        }

        // MOVIMENTAÇÃO

        return redirect('/granel');
    }

    public function informar(){
        $graneis = Granel::all();

        return view('granel.informar', array('graneis' => $graneis));
    }

    public function atualizar(Request $request){

        $request = $request->all();

        $itemEstoque = GranelEstoque::where('granel_id','=',$request["granel_id"])->first();

        if($itemEstoque){
            $itemEstoque->quantidade = $request["quantidade"];

            $itemEstoque->save();

            $informarEstoque = new InformarEstoque();

            $informarEstoque->granel_id = $request["granel_id"];
            $informarEstoque->quantidade = $request["quantidade"];
            $informarEstoque->justificativa = $request["justificativa"];

            $informarEstoque->save();
        }

        return redirect('/granel');
    }
}
