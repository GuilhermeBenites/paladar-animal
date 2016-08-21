@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Granel</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Acompanhar Estoque</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Granel</th>
                                    <th>Quantidade</th>
                                    <th>Preço KG</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($graneis as $granel)
                                    <tr>
                                        <td>{{$granel->granel->nome}}</td>
                                        <td>{{$granel->quantidade}}</td>
                                        <td>{{$granel->preco}}</td>
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
