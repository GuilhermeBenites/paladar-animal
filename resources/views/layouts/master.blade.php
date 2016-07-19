<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Paladar Animal</title>

  <!-- Bootstrap -->
  <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Paladar Animal</span></a>
        </div>

        <div class="clearfix"></div>

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <ul class="nav side-menu">
              <li><a><i class="fa fa-home"></i> Início <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="index.html">Painel</a>
                  </li>
                </ul>
              </li>
              <li><a><i class="fa fa-usd"></i> Caixa <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{url('vendas')}}">Venda</a>
                  </li>
                  <li><a href="#">Abrir Caixa</a>
                  </li>
                  <li><a href="#">Fechar Caixa</a>
                  </li>
                  <li><a href="#">Consultar Preço</a>
                  </li>
                  <li><a href="#">Histórico de Vendas</a>
                  </li>
                </ul>
              </li>
              <li><a><i class="fa fa-truck"></i> Estoque <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{url('estoque')}}">Estoque Atual</a>
                  </li>
                  <li><a href="#">Histórico de Movimentações</a>
                  </li>
                  <li><a href="#">Entrada de Mercadoria</a>
                  </li>
                  <li><a href="#">Baixa de Mercadoria</a>
                  </li>
                </ul>
              </li>
              <li><a><i class="fa fa-users"></i> Fornecedores <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="#">Fornecedores</a>
                  </li>
                  <li><a href="#">Novo Fornecedor</a>
                  </li>
                </ul>
              </li>
              <li><a><i class="fa fa-bar-chart-o"></i> Granel <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="#">Acompanhar???</a>
                  </li>
                  <li><a href="#">Abrir Saco</a>
                  </li>
                </ul>
              </li>
              <li><a><i class="fa fa-archive"></i> Produtos <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{url('produtos')}}">Produtos</a>
                  </li>
                  <li><a href="{{url('produtos/novo')}}">Novo Produto</a>
                  </li>
                </ul>
              </li>
              <li><a><i class="fa fa-tags"></i> Categorias <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{url('categorias')}}">Categorias</a>
                  </li>
                  <li><a href="{{url('categorias/novo')}}">Nova Categoria</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </div>
        <!-- /sidebar menu -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">

      <div class="nav_menu">
        <nav class="" role="navigation">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Sair</a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>

    </div>
    <!-- /top navigation -->

    @yield('content')

            <!-- footer content -->
    <footer>
      <div class="pull-right">
        Benites Corporation
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>

<!-- jQuery -->
<script src="/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="/js/custom.js"></script>

<script src="/js/jquery.mask.min.js"></script>

<script type="application/javascript">
  $(document).ready(function(){
    $('.preco').mask('000.000.000.000.000,00', {reverse: true});
  });
</script>
</body>
</html>
