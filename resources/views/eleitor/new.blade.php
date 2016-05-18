@extends('welcome')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cadastrar Eleitor</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Novo Eleitor
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            <form role="form">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input class="form-control" placeholder="João">
                                </div>
                                <div class="form-group">
                                    <label>Sobrenome</label>
                                    <input class="form-control" placeholder="da Silva Santos">
                                </div>

                                <button type="submit" class="btn btn-default">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@stop