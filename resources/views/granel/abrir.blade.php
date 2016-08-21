@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Abrir Saco</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form class="form-horizontal form-label-left" action="abrir" method="post">

                                {{ method_field('POST') }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Granel</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="granel_id">
                                            @foreach ($graneis as $granel)
                                                <option value="{{$granel->id}}">{{$granel->codigo}} - {{$granel->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ração</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="produto_id">
                                            @foreach ($racoes as $racao)
                                                <option value="{{$racao->id}}">{{$racao->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if ($errors->has('quantidade'))
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Quantidade em gramas
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="quantidade" name="quantidade" class="form-control col-md-7 col-xs-12 parsley-error" value="{{ old('quantidade') }}">
                                            <ul class="parsley-errors-list filled" id="parsley-id-20">
                                                <li class="parsley-required">{{ $errors->first('quantidade') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Quantidade em gramas
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="quantidade" name="quantidade" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                @endif

                                @if ($errors->has('preco'))
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="preco">Preço do KG
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="preco" name="preco" class="form-control col-md-7 col-xs-12 parsley-error" value="{{ old('preco') }}">
                                            <ul class="parsley-errors-list filled" id="parsley-id-20">
                                                <li class="parsley-required">{{ $errors->first('preco') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="preco">Preço do KG
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="preco" name="preco" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                @endif

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a class="btn btn-primary" href="{{url('granel')}}">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop
