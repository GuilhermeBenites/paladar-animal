@extends('layouts.master')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="page-title">
      <div class="title_left">
        <h3>Categorias</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Categorias Cadastradas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

              @foreach ($categorias as $categoria)
                <tr>
                  <td>{{$categoria->nome}}</td>
                  <td><button type="button" class="btn btn-round btn-warning"><i class="fa fa-search"></i></button></td>
                  <td><button type="button" class="btn btn-round btn-danger"><i class="fa fa-times"></i></button></td>
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
