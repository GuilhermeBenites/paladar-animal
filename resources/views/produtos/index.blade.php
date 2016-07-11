@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Produtos</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Produtos Cadastrados</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Categoria</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td>{{$produto->codigo}}</td>
                                        <td>{{$produto->nome}}</td>
                                        <td>R$ {{$produto->preco}}</td>
                                        <td>{{ $produto->categoria->nome }}</td>
                                        <td>
                                            <form action="{{ url('produtos/editar/'.$produto->id) }}" method="GET">
                                                {{ csrf_field() }}
                                                {{ method_field('GET') }}

                                                <button type="submit" class="btn btn-round btn-warning">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ url('produtos/'.$produto->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-round btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
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
