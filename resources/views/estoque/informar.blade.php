@extends('layouts.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Informar Estoque</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form class="form-horizontal form-label-left" action="informar" method="post">

                                {{ method_field('POST') }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Produto</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="produto_id">
                                            @foreach ($produtos as $produto)
                                                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if ($errors->has('quantidade'))
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Quantidade
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Quantidade
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="quantidade" name="quantidade" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Justificativa
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="justificativa" name="justificativa" class="form-control col-md-7 col-xs-12" rows="7"></textarea>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a class="btn btn-primary" href="{{url('/')}}">Cancelar</a>
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
