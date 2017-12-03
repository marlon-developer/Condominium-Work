<!--Foi Adicionado alguns campos que não continham no protótipo mas tinham no banco e layout diferente para poder se ajustar e ficar visualmente mais agradável-->


<?php
  require '../../src/Connection.php';
  $db = new Connection();
  
  //Query
  $condominio = $db->DBRead('condominio', null , '*');
  $pessoa = $db->DBRead('pessoa', null , '*');
  $unidade = $db->DBRead('unidade', null , '*');
  $bloco = $db->DBRead('bloco', 'WHERE descricao = descricao' , '*');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Unidade</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <!--<link rel="stylesheet" href="../../plugins/iCheck/all.css">-->
    <link rel="stylesheet" href="../../plugins/iCheck/minimal/minimal.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="../../index.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SG</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Seu Geraldo</b><sub> <strong>SG</strong> </sub></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>

            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="../../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="../../dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="../../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="../../dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Create a nice theme
                                                <small class="pull-right">40%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Some task I need to do
                                                <small class="pull-right">60%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Make beautiful transitions
                                                <small class="pull-right">80%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-plus"></i> <span>Cadastros</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="AdicionarCondominio.php"><i class="fa fa-circle-o"></i> Condomínio</a></li>
                        <li><a href="AdicionarReceitasDespesas.php"><i class="fa fa-circle-o"></i> Despesas e Receitas</a></li>
                        <li class="active"><a href="AdicionarContaBancaria.php"><i class="fa fa-circle-o"></i> Conta Bancária</a></li>
                        <li><a href="AdicionarContaCategoria.php"><i class="fa fa-circle-o"></i> Conta Categoria</a></li>
                        <li><a href="./pages/forms/CadastrarCondomino.php"><i class="fa fa-circle-o"></i> Condominos</a></li>
                        <li><a href="./pages/forms/AdicionarUnidade.php"><i class="fa fa-circle-o"></i> Unidades</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-reorder"></i> <span>Listagem</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="./ReceitasDespesas.php"><i class="fa fa-circle-o"></i> Despesas e Receitas</a></li>
                        <li><a href="./ContaBancaria.php"><i class="fa fa-circle-o"></i> Conta Bancária</a></li>
                        <li><a href="./ContaCategoria.php"><i class="fa fa-circle-o"></i> Conta Categoria</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../CalendarioDeReservas.php">
                        <i class="fa fa-calendar"></i> <span>Calendário de reservas</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

       <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cadastro de Unidade</h1>
    </section>

<!-- Main content -->
<section class="content">
<form method="POST" action="../../src/ClassUnidade.php">
    <div class="row">

        <!-- Coluna Esquerda -->
        <div class="col-md-12">
            <!-- Input addon -->
            <div  class="box box-info">
                <!-- Primeira Coluna -->
                <div class="col-md-6">

                    <!--Campo Condomínio-->
                    <div class="form-group" style="margin-bottom: 40px">
                        <label for="sel2">Condomínio</label>
                        <select class="form-control" name="id_condominio" autofocus>
                            <?php foreach ($condominio as $c) echo "<option value='$c[id_condominio]'>".$c['nome']."</option>";?>
                        </select>
                    </div>

                    <!--Campo Tipo de Unidade-->
                    <div style="margin-bottom: 45px">
                        <label for="sel2">Tipo de Unidade</label>
                        <input type="text" class="form-control" name="tipo" placeholder="Tipo de Unidade" required>
                    </div> 

                    <!--Campo Nome da Unidade-->
                    <div style="margin-bottom: 40px">
                        <label for="sel2">Nome da Unidade</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Nome da Unidade" required>
                    </div>

                      <!--Campo Número da Unidade-->
                    <div style="margin-bottom: 40px">
                        <label for="sel2">Número da Unidade</label>
                        <input type="number" class="form-control" name="numero" placeholder="Número da Unidade" required>
                    </div>

                    <div class="col-md-6">
                        <!--Campo Quartos-->
                        <div style="margin-bottom: 50px">
                            <label for="sel2">Quartos</label>
                            <select class="form-control" name="numero_quartos">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Campo Seleciona Garagem-->
                        <div style="margin-bottom: 20px">
                            <label for="sel2">Garagens</label>
                            <select class="form-control" name="numero_garagens">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>    
                        </div>
                    </div>       
                <br>
                <!--Fim da Coluna Esquerda-->
                </div>


                <!-- Coluna Direita-->
                <div class="col-md-6" style="margin-bottom: 20px">

                    <!--Campo Área-->
                    <div style="margin-bottom: 40px">
                        <label for="sel2">Area(M²)</label>
                        <input type="number" class="form-control" id="sel_bloco" name="id_unidade" placeholder="Area(M²)" required> 
                    </div>

                    <!--Campo Fração Ideal-->
                    <div style="margin-bottom: 20px">
                        <label for="sel2">Fração Ideal (R$)</label>
                        <input type="number" class="form-control" name="valor_fracao_ideal" placeholder="Fração Ideal (R$)" required>       
                    </div> 

                    <!--Campo Para Locação da Unidade-->
                    <div class="form-check" align="left">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="locacao" onclick="habilitar_condomino()" checked>
                            Pode ser locado
                        </label>
                    </div>

                   <!--Campo Condômino-->
                    <div style="margin-bottom: 15px">
                        <label for="sel12">Condômino</label>
                        <select class="form-control" id="pessoa" name="pessoa">
                            <?php foreach ($pessoa as $p) echo "<option value='$p[id_pessoa]'>".$p['nome']."</option>";?>
                        </select>
                    </div>


                    <!--Campo Verifica se pertence a outra Unidade-->
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="outra_unidade" onclick="habilitar_unidade()" checked>
                            Pertence a outra unidade
                        </label>
                    </div>

                    <!--Campo Seleciona Unidade-->
                    <div style="margin-bottom: 15px">
                        <label for="sel12">Unidade</label>
                        <select class="form-control" id="unidade" name="unidade">
                            <?php foreach ($unidade as $u) echo "<option value='$u[id_unidade]'>".$u['descricao']."</option>";?>
                        </select>
                    </div>
               

                    <!--Campo Verifica se pertence a algum Bloco-->
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="outro_bloco" onclick="habilitar_bloco()" checked>
                            Pertence a um bloco
                        </label>
                    </div>

                    <!--Campo Seleciona Bloco-->
                    <div style="margin-bottom: 20px">
                        <label for="sel12">Bloco</label>
                        <select class="form-control" name="bloco" id="bloco">
                            <?php foreach ($bloco as $b) echo "<option value='$b[id_bloco]'>".$b['descricao']."</option>";?>
                        </select>
                    </div> 
                <br>
                <!--Fim da Coluna Direita-->
                </div>
                           
                <!--Botões-->
                <div class="col-md-12" align="center">
                    <button type="submit" class="btn btn-danger" style="margin-left: 15px;">Cancelar</button>
                    <button type="reset" class="btn btn-default">Limpar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>


            </div>
        </div>
                    <!-- /.box -->
    </div>
                <!--/.col (right) -->
    <!-- /.row -->
</form>
</section>
    <!-- /.content -->
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 Seu Geraldo.</strong> All rights reserved.
    </footer>

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('mm/dd/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button


        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })

        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal',
                increaseArea: '20%' // optional
            });
        });

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })

        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        // $("#submitForm").on('click', function(e){
        //     var formData = {
        //         codigoBanco: $("#codigoBanco").val(),
        //         categoria: $("#categoria").val(),
        //         agencia: $("#agencia").val(),
        //         agenciaDigito: $("#agenciaDigito").val(),
        //         contaCorrente: $("#contaCorrente").val(),
        //         contaCorrenteDigito: $("#contaCorrenteDigito").val(),
        //         saldo: $("#saldo").val(),
        //         data: $("#data").val(),
        //         statusAtivo: $("#statusAtivo").val(),
        //         statusInativo: $("#statusInativo").val(),
        //     }

        //     $.ajax({
        //         type: "POST",
        //         url: "ContaBancaria.php/?action=add",
        //         data: formData,
        //         success: function( data ){
        //             console.log(data);
        //         }
        //     })
        // });

    })
</script>

</body>
</html>

<script>
    function habilitar_condomino(){
        if (document.getElementById('locacao').checked) document.getElementById('pessoa').disabled = false;
        else document.getElementById('pessoa').disabled = true;
    }

    function habilitar_unidade(){
        if (document.getElementById('outra_unidade').checked) document.getElementById('unidade').disabled = false;
        else document.getElementById('unidade').disabled = true;
    }

    function habilitar_bloco(){
        if (document.getElementById('outro_bloco').checked) document.getElementById('bloco').disabled = false;
        else document.getElementById('bloco').disabled = true;
    }  
</script>