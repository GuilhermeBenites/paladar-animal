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

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Estoque Atual</h2>
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

                                @foreach($estoque as $item)
                                    <tr>
                                        <td>{{$item->produto->codigo}}</td>
                                        <td>{{$item->produto->nome}}</td>
                                        <td>{{$item->quantidade}}</td>
                                        <td>Nível</td>
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
