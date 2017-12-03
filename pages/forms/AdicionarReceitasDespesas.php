<!--/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 12/11/2017
 * Time: 19:39
 */-->

<?php

    setlocale (LC_ALL, 'ptb_ptb');

    require '../../src/Connection.php';
    require '../../src/ReceitasDespesas.php';

    $query = new Connection();
    $novaDespesaReceita = new ReceitasDespesas();

    $listarUnidades  = $query->DBRead('unidade', NULL, 'id_unidade, descricao');
    $listarPessoas   = $query->DBRead('pessoa', NULL, 'nome');
    $listarCondominio= $query->DBRead('condominio', NULL, 'nome');
    $listarConta     = $query->DBRead('conta_bancaria', NULL, '*');
    $listarCategoria = $query->DBRead('conta_categoria','ORDER BY titulo ASC', '*' );


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Despesas / Receitas</title>
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
<style>
    .esconder{
        display: none;
    }
    .mostrar{
        visibility: visible;
    }
</style>
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


                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Seu Geraldo</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Seu Geraldo - Síndico
                                </p>
                            </li>
                            <!-- Menu Body -->

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
                    <p>Seu Geraldo</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Sempre Online</a>
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
                        <i class="fa fa-edit"></i> <span>Cadastros</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="AdicionarCondominio.php"><i class="fa fa-circle-o"></i> Condomínio</a></li>
                        <li class="active"><a href="AdicionarReceitasDespesas.php"><i class="fa fa-circle-o"></i> Despesas e Receitas</a></li>
                        <li><a href="AdicionarContaBancaria.php"><i class="fa fa-circle-o"></i> Conta Bancária</a></li>
                        <li><a href="AdicionarContaCategoria.php"><i class="fa fa-circle-o"></i> Categoria</a></li>
                        <li><a href="AdicionarUnidade.php"><i class="fa fa-circle-o"></i> Unidades</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>Listagem</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="ListarCondominios.php"><i class="fa fa-circle-o"></i> Condomínio</a></li>
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
            <h1>
                Cadastro de Receitas Despesas
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="AdicionarReceitasDespesas.php" method="post">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <!-- Input addon -->
                        <div  class="box box-info">
                            <!--<div class="box-header with-border">
                            <h3 class="box-title">Tipo</h3>
                        </div>-->

                            <div class="box-body" style="margin-top: 20px">
                                <div class="form-group" align="center">
                                    <label style="margin-right: 30px">
                                        <input type="radio" name="rbtipo" class="minimal-red" value="0" checked id="receitas"  onfocus="document.getElementById('conta').style.display='block';
                                    document.getElementById('receitas').checked='true';
                                    document.getElementById('pagamento').style.display='none';
                                    document.getElementById('responsavel').style.display='none';
                                    document.getElementById('unidade').style.display='none';
                                    document.getElementById('condominio').style.display='none';
                                    document.getElementById('check').style.display='none';">
                                        Receitas
                                    </label>
                                    <label style="margin-left: 30px">
                                        <input type="radio" name="rbtipo" class="minimal-red" value="1" id="despesas" onfocus="document.getElementById('conta').style.display='none';
                                    document.getElementById('despesas').checked='true';
                                    document.getElementById('pagamento').style.display='block';
                                    document.getElementById('check').style.display='block'">
                                        Despesas
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="conta" name="conta" style="display: none">
                                    <label for="conta">Conta</label>
                                    <select class="form-control"  id="conta">
                                        <?php
                                            foreach ($listarConta as $contas) {
                                                echo "<option value='$contas[id_conta_bancaria]'>" . "Agência: " . $contas['agencia'] . " - " . "Conta: "  . $contas['conta'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="unidade" name="unidade" style="display: none">
                                    <label for="unidade">Unidade</label>
                                    <select class="form-control"  id="unidade">
                                        <?php
                                            foreach ($listarUnidades as $unidades) {
                                                echo "<option value='$unidades[id_unidade]'>" . $unidades['descricao'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="responsavel" name="responsavel" style="display: none">
                                    <label for="responsavel">Responsável</label>
                                    <select class="form-control" id="responsavel">
                                        <?php
                                            foreach ($listarPessoas as $pessoas) {
                                                echo "<option value='$pessoas[id_pessoa]'>" . $pessoas['nome'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="condominio" name="condominio" style="display: none">
                                    <label for="condominio">Condomínio</label>
                                    <select class="form-control"  id="condominio">
                                        <?php
                                            foreach ($listarCondominio as $condominios) {
                                                echo "<option value='$condominios[id_condominio]'>" . $condominios['nome'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <select class="form-control" id="categoria">
                                        <?php
                                            foreach ($listarCategoria as $categorias) {
                                                echo "<option value='$categorias[id_categoria]'>" . $categorias['titulo'] . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="box-body" id="check">
                                <div class="form-group" style="margin-left:15px">
                                    <label for="uindade" style="margin-right: 30px">
                                        <input type="radio" name="rbResponsavel" checked id="unidade" value="1" onfocus="document.getElementById('unidade').style.display='block';
                                    document.getElementById('unidade').checked='true';
                                    document.getElementById('condominio').style.display='none';
                                    document.getElementById('responsavel').style.display='none';
                                    if(document.getElementById('unidade').checked='true')">
                                        Unidade
                                    </label>
                                    <label for="responsavel" style="margin-left: 30px">
                                        <input type="radio" name="rbResponsavel" id="responsavel" value="2" onclick="document.getElementById('responsavel').style.display='block';
                                    document.getElementById('responsavel').checked='true';
                                    document.getElementById('unidade').style.display='none';
                                    document.getElementById('condominio').style.display='none'">
                                        Responsável
                                    </label>

                                    <label for="condominio" style="margin-left: 60px">
                                        <input type="radio" name="rbResponsavel" id="condominio" value="3" onclick="document.getElementById('condominio').style.display='block';
                                    document.getElementById('condominio').checked='true';
                                    document.getElementById('unidade').style.display='none';
                                    document.getElementById('responsavel').style.display='none'">
                                        Condomínio
                                    </label>
                                </div>
                            </div>

                            <div class="box-body">
                                <div>
                                    <label style="margin-left: 7px">Valor</label>
                                    <div class="input-group col-md-3" style="margin-left: 5px">
                                        <span class="input-group-addon">R$</span>
                                        <label for="rs"></label>
                                        <input type="text" class="form-control" id="rs">
                                    </div>
                                </div>
                                <div class="box-body" style="position: relative; margin:-60px 0 0 650px">
                                    <label style="margin-left: -2px">Classificação</label><br>
                                    <label for="fixa" style="margin-right: 30px">
                                        <input type="radio" name="rbclassificacao" checked id="fixa" value="1">
                                        Fixa
                                    </label>
                                    <label for="variavel" style="margin-left: 30px">
                                        <input type="radio" name="rbclassificacao" id="variavel" value="2">
                                        Variável
                                    </label>
                                </div>
                                <!-- /.input group -->
                                <br>
                                <div class="box-body" style="margin-left: -20px">
                                    <div class="form-group col-lg-4">
                                        <label for="referencia">Referência</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="referencia" maxlength="6" required="required" data-inputmask="'alias': 'mm/yyyy'" data-mask name="referencia">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4" style="position: relative; margin:-75px 0 0 600px">
                                        <label for="datepicker">Data de Cobrança</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon"">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" required="required" name="cobranca">
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group col-lg-4" id="pagamento">
                                    <label for="datepicker">Data de Pagamento</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon"">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" required="required" name="pagamento">
                                </div>
                            </div>

                            <div class="col-md-12" align="center">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <button type="submit" class="btn btn-default" style="margin-left: 15px;">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (right) -->
    </div>
    <!-- /.row -->
    </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2017 Seu Geraldo.</strong> All rights
    reserved.
</footer>

<!--Ajax-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
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
    $(document).ready(function() {
        function mostra(id){

        }

        $('input').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal',
            increaseArea: '20%' // optional
        });
    });

    //Colorpicker
    $('.my-colorpicker1').colorpicker();
    //color picker with addon
    $('.my-colorpicker2').colorpicker();

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    });

    $('.select2').select2();

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    //Datemask2 mm/yyyy
    $('#datemask2').inputmask('mm/yyyy', { 'placeholder': 'mm/yyyy' });

    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' });
    //Date range as a button
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })
    })
</script>

</body>
</html>
<?php
    if (@$_POST['rbTipo']) {

        $tipo = $_POST['rbTipo'];

        $respUnid = $_POST['unidade'];
        $respResp = $_POST['responsavel'];
        $respCond = $_POST['condominio'];

        $categoria = $_POST['categoria'];

        $conta = $_POST['conta'];

        $responsavel = $_POST['rbResponsavel'];

        $valor = $_POST['rs'];

        $conta = $_POST['conta'];

        $classificacao = $_POST['rbClassificacao'];

        $referencia = $_POST['referencia'];

        $cobranca = $_POST['cobranca'];

        $pagamento = $_POST['pagamento'];

        @$novaDespesaReceita->insereReceitaDespesa($tipo, $respUnid, $respResp,
            $respCond, $categoria, $conta,
            $classificacao, $referencia, $cobranca , $pagamento);
    }
?>