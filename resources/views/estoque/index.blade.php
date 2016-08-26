@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Estoque</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                @foreach($categorias as $categoria)

                    @if(count($estoques[$categoria->nome]) != 0)

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Estoque de {{$categoria->nome}}</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Quantidade</th>
                                            <th>Nível</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($estoques[$categoria->nome] as $item)
                                            <tr>
                                                <td>{{$item->produto->codigo}}</td>
                                                <td>{{$item->produto->nome}}</td>
                                                <td>{{$item->quantidade}}</td>
                                                @if($item->quantidade > (2*$item->produto->nivel_critico))
                                                    <td>
                                                        <span class="label label-success">OK</span>
                                                    </td>
                                                @elseif($item->quantidade > $item->produto->nivel_critico)
                                                    <td>
                                                        <span class="label label-warning">Cuidado</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="label label-danger">Nível Crítico</span>
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop
