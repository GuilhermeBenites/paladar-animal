@extends('layouts.master')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Venda</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Adicionar Produto</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form class="form-horizontal form-label-left" action="vendas/addproduto" method="post">

                                {{ method_field('POST') }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Produto</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                        <select class="selectpicker form-control" data-live-search="true" name="produto_id">
                                            @foreach($produtos as $produto)
                                                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantidade
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="quantidade" name="quantidade"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Adicionar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Adicionar Granel</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form class="form-horizontal form-label-left" action="vendas/addgranel" method="post">

                                {{ method_field('POST') }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Granel</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="granel_id">
                                            @foreach($graneis as $granel)
                                                <option value="{{$granel->id}}">{{$granel->codigo}} - {{$granel->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantidade em gramas
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="quantidade" name="quantidade"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Adicionar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->has("estoque"))
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                        <div class="x_content bs-example-popovers">

                            <div class="alert alert-danger alert-dismissible fade in text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">×</span>
                                </button>
                                {{$errors->first("estoque")}}
                            </div>
                        </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-10 col-xs-10">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Produtos Adicionados</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unidade</th>
                                    <th>Preço Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($itensVenda as $item)
                                    <tr>
                                        @if($item->produto == null)
                                            <td>{{$item->granel->codigo}}</td>
                                            <td>{{$item->granel->nome}}</td>
                                            <td>{{$item->quantidade}} g</td>
                                        @else
                                            <td>{{$item->produto->codigo}}</td>
                                            <td>{{$item->produto->nome}}</td>
                                            <td>{{$item->quantidade}}</td>
                                        @endif

                                        <td class="precoShow">R$ {{$item->precoUnidade}}</td>
                                        <td class="precoShow">R$ {{$item->total}}</td>
                                        <td>
                                            <form action="{{ url('vendas/item/'.$item->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-round btn-danger">
                                                    <i class="fa fa-trash"></i> Remover
                                                </button>
                                            </form>
                                        <td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td style="font-weight: bold;">TOTAL</td>
                                    <td style="font-weight: bold;" class="precoShow">R$ {{$totalDeVendas}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-10 col-xs-10">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                        <form action="vendas/finalizar" method="post">

                            {{ method_field('POST') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="total" value="{{$totalDeVendas}}">

                            <button type="submit" class="btn btn-primary">Finalizar Venda</button>
                        </form>
                    </div>
                    <form action="{{ url('vendas/') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i> Cancelar Venda
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop
