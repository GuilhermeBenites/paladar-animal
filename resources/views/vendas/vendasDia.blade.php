@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <div class="title_left">
                    <h3>Histórico de Vendas</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">

                    <!-- form date pickers -->
                    <div class="x_panel" style="">
                        <div class="x_title">
                            <h2>Pesquisa</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="row">

                                <div class="col-md-3">
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="col-md-11 form-group">
                                                    <form action="{{ url('vendas/vendas-do-dia-pesquisa/') }}" class="form-horizontal form-label-left" method="GET">
                                                        {{ csrf_field() }}
                                                        {{ method_field('GET') }}
                                                        <div class="form-group">
                                                            <div>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="diaVenda" placeholder=" Escolha o dia" id="single_cal4">
                                                                    <span class="input-group-btn">
                                                                      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                  </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /form datepicker -->
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Vendas do Dia {{$dia}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- start accordion -->
                            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">

                                @forelse ($vendasItems as $vendasItem)
                                    <div class="panel">
                                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#{{$vendasItem["id"]}}" aria-controls="{{$vendasItem["id"]}}">
                                            <h4 class="panel-title">Venda no {{$vendasItem["dia"]}} - Valor Total R$ {{$vendasItem["total"]}}</h4>
                                        </a>
                                        <div id="{{$vendasItem["id"]}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Produto/Granel</th>
                                                        <th>Quantidade</th>
                                                        <th>Valor Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($vendasItem["itens"] as $item)
                                                        <tr>
                                                            @if($item->produto != null)
                                                                <th>{{$item->produto->codigo}}</th>
                                                                <th>{{$item->produto->nome}}</th>
                                                            @else
                                                                <th>{{$item->granel->codigo}}</th>
                                                                <th>{{$item->granel->nome}}</th>
                                                            @endif
                                                            <td>{{$item->precoUnidade}}</td>
                                                            <td>{{$item->precoUnidade * $item->quantidade}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>Não há vendas</p>
                            @endforelse
                            <!-- end of accordion -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop
