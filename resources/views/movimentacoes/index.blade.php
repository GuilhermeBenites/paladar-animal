@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Movimentações</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Movimentações de Estoque</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Razão</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($movimentacoes as $movimentacao)
                                    <tr>
                                        @if($movimentacao->razao == 'venda')
                                            <td>
                                                <span class="label label-success">Venda</span>
                                            </td>
                                        @elseif($movimentacao->razao == 'entrada')
                                            <td>
                                                <span class="label label-warning">Entrada</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="label label-danger">Baixa</span>
                                            </td>
                                        @endif
                                            @if($movimentacao->produto == null)
                                                <td>{{$movimentacao->granel->nome}}</td>
                                            @else
                                                <td>{{$movimentacao->produto->nome}}</td>
                                            @endif
                                        <td>{{$movimentacao->quantidade}}</td>
                                        <td>{{$movimentacao->created_at}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop
