<?php

    // ini_set("error_reporting", E_ALL);
    // ini_set("display_errors", 1);

    include dirname(__FILE__).'../../src/Connection.php';
    include dirname(__FILE__)."../../src/DataBase.php";

    function validador ( $dataInicio, $dataFim ) {
        $json = ["success" => false];

        if (  $dataInicio == null || $dataFim == null ) {
            $json["message"] = "Preencha a data de início e de fim";
        } else if ( $dataInicio->format("Y-m-d") !== $dataFim->format("Y-m-d") ) {
            $json["message"] = "Data de início e fim são diferentes";
        } else if ($dataInicio->getTimeStamp() > $dataFim->getTimeStamp() ) {
            $json["message"] = "Horário de início é maior que o de fim";
        } else if ($_POST["id_responsavel"] == "") {
            $json["message"] = "Nenhum responsável informado";
        } else if ($_POST["id_unidade"] == "") {
            $json["message"] = "Nenhum salão informado";
        } else if ($_POST["valor"] == "") {
            $json["message"] = "Nenhum valor informado";
        } else {
            $json["success"] = true;
        }

        return $json;
    }

    $mysql = Connection::DBConnect();

    $queryAssoc = function ( $resources ) {
        $data = [];

        while ( $row = mysqli_fetch_assoc($resources)) {
            $data[] = $row;
        }

        return $data;
    };




    if ( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        $json = ["success" => false];
        if (  isset($_POST["id_reserva"]) && $_POST["id_reserva"] ) {
            if ( $_POST["action"] == "editar" ) {

                $dataInicio = DateTime::createFromFormat("Y-m-d\TH:i:s", $_POST["data_inicio"]);
                $dataFim = DateTime::createFromFormat("Y-m-d\TH:i:s", $_POST["data_fim"]);
                $json = validador($dataInicio, $dataFim);
                if ($json["success"]) {
                    $mysql->query(sprintf("UPDATE
                            unidade_reserva
                        SET valor = %d,
                            horario_inicial = '%s',
                            horario_final = '%s',
                            data = '%s',
                            id_pessoa = %d,
                            id_unidade = %d
                        WHERE
                            id_unidade_reserva = %d",
                                $_POST["valor"],
                                $dataInicio->format("H:i:s"),
                                $dataFim->format("H:i:s"),
                                $dataInicio->format("Y-m-d"),
                                $_POST["id_responsavel"],
                                $_POST["id_unidade"],
                                $_POST["id_reserva"]));
                }
            } else if ( $_POST["action"] == "remover" ) {
                $mysql->query(sprintf("DELETE FROM unidade_reserva WHERE id_unidade_reserva = %d", $_POST["id_unidade_reserva"]));
                $json["success"] = true;
            }
        } else {
            $dataInicio = DateTime::createFromFormat("Y-m-d\TH:i", $_POST["data_inicio"]);
            $dataFim = DateTime::createFromFormat("Y-m-d\TH:i", $_POST["data_fim"]);

            $json = validador($dataInicio, $dataFim);
            if ( $json["success"] ) {
                $mysql->query(sprintf("INSERT INTO
                                        unidade_reserva
                                        (data, horario_inicial ,horario_final ,id_pessoa ,id_unidade, valor)
                                        VALUES ('%s', '%s', '%s', %d, %d, %d)",

                                    $dataInicio->format("Y-m-d"),
                                    $dataInicio->format("H:i:s"),
                                    $dataFim->format("H:i:s"),
                                    $_POST["id_responsavel"],
                                    $_POST["id_unidade"],
                                    $_POST["valor"]
                                ));
            }



        }
        header("Content-Type: application/json");
        header("Content-Length: application/json", count(json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)));
        die(json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }



    $result = $mysql->query("SELECT
                                A.id_unidade_reserva,
                                A.valor,
                                A.data as data,
                                A.horario_inicial as inicio,
                                A.horario_final as fim,
                                B.id_pessoa as id_usuario,
                                C.id_unidade as id_unidade,
                                B.nome, IF(B.telefone_residencial IS NOT NULL,
                                B.telefone_residencial, B.telefone_celular) as telefone,
                                C.numero as numero_unidade,
                                IF(A.horario_final BETWEEN date(NOW()) AND date(NOW()) + INTERVAL 1 DAY, 0, IF(A.horario_final >= date(NOW() + INTERVAL 1 DAY), 1, -1))
                        FROM unidade_reserva as A
                            INNER JOIN pessoa as B ON A.id_pessoa = B.id_pessoa
                            INNER JOIN unidade as C ON A.id_unidade = C.id_unidade");

    $usuarios = $queryAssoc($mysql->query("SELECT
                                nome,
                                id_pessoa
                            FROM pessoa"));

    $saloes = $queryAssoc($mysql->query("SELECT
                                id_unidade,
                                numero
                            FROM unidade"));

    $results = $queryAssoc($result);

    $todayColor = "#00a65a";
    $pastColor = "#e0e0e0";
    $futureColor = "#00c0ef";
    $data = [];

    // $counter = 0;
    // $results = [
    //     [
    //         "valor" => 2000,
    //         "nome" => "MArcio",
    //         "data" => "2017-11-23",
    //         "inicio" => "12:49:33",
    //         "fim" => "18:49:33",
    //         "telefone" => "(55) 8100-1777",
    //         "id_unidade" => ++$counter,
    //         "id_unidade_reserva" => $counter,
    //         "id_pessoa" => $counter,
    //         "numero_unidade" => "1455655dd"
    //     ],
    //     [
    //         "valor" => 2000,
    //         "nome" => "MArcio",
    //         "data" => "2017-11-23",
    //         "inicio" => "12:49:33",
    //         "fim" => "18:49:33",
    //         "telefone" => "(55) 8100-1777",
    //         "id_unidade" => ++$counter,
    //         "id_unidade_reserva" => $counter,
    //         "id_pessoa" => $counter,
    //         "numero_unidade" => "1455655dd"
    //     ],
    //     [
    //         "valor" => 2000,
    //         "nome" => "MArcio",
    //         "data" => "2017-11-23",
    //         "inicio" => "12:49:33",
    //         "fim" => "18:49:33",
    //         "telefone" => "(55) 8100-1777",
    //         "id_unidade" => ++$counter,
    //         "id_unidade_reserva" => $counter,
    //         "id_pessoa" => $counter,
    //         "numero_unidade" => "1455655dd"
    //     ],
    //     [
    //         "valor" => 2000,
    //         "nome" => "MArcio",
    //         "data" => "2017-11-23",
    //         "inicio" => "12:49:33",
    //         "fim" => "18:49:33",
    //         "telefone" => "(55) 8100-1777",
    //         "id_unidade" => ++$counter,
    //         "id_unidade_reserva" => $counter,
    //         "id_pessoa" => $counter,
    //         "numero_unidade" => "1455655dd"
    //     ],
    // ];

    foreach ( $results as $item ) {

        $d = [];

        $item["numero_unidade"] = $item["numero_unidade"] ? $item["numero_unidade"]: "Não informado";

        $d["start"] = "{$item["data"]} {$item["inicio"]}";
        $d["end"] = "{$item["data"]} {$item["fim"]}";
        $d["title"] = [];
        $d["title"][] = "\n";
        $d["title"][] = "Responsável: {$item["nome"]}";
        $d["title"][] = "Valor: {$item["valor"]}";
        $d["title"][] = "Contato: {$item["telefone"]}";
        $d["title"][] = "Unidade: {$item["numero_unidade"]}";
        $d["title"] = implode("\n", $d["title"]);

        $d["id_unidade_reserva"] = $item["id_unidade_reserva"];
        $d["valor"] = $item["valor"];
        $d["data_inicio"] = "{$item["data"]}T{$item["inicio"]}";
        $d["data_fim"] = "{$item["data"]}T{$item["fim"]}";
        $d["id_pessoa"] = $item["id_pessoa"];
        $d["id_unidade"] = $item["id_unidade"];
        $data[] = $d;
        unset($d);
    }

    $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    // die($data);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Despesas / Receitas</title>
    <base href="http://localhost/SeuGeraldo/">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <!--<link rel="stylesheet" href="plugins/iCheck/all.css">-->
    <link rel="stylesheet" href="plugins/iCheck/minimal/minimal.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

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
        <a href="index.html" class="logo">
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
                                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
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
                                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
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
                                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
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
                                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
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
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

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
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Cadastros</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="AdicionarReceitasDespesas.php"><i class="fa fa-circle-o"></i> Despesas e Receitas</a></li>
                        <li class="active"><a href="AdicionarContaBancaria.php"><i class="fa fa-circle-o"></i> Conta Bancária</a></li>
                        <li><a href="AdicionarContaCategoria.php"><i class="fa fa-circle-o"></i> Conta Categoria</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Listagem</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/forms/ReceitasDespesas.php"><i class="fa fa-circle-o"></i> Despesas e Receitas</a></li>
                        <li><a href="pages/forms/ContaBancaria.php"><i class="fa fa-circle-o"></i> Conta Bancária</a></li>
                        <li><a href="pages/forms/ContaCategoria.php"><i class="fa fa-circle-o"></i> Conta Categoria</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="pages/CalendarioDeReservas.php">
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
                Calendário de Reservas
            </h1>

            <button id="registrar-reserva" type="button">Registrar reserva</button>
            <button id="editar-reservas" type="button">Editar reservas</button>

        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <!-- Input addon -->
                    <div  class="box box-info" style="position: relative">
                        <div class="box-body">
                            <div id="calendario-reservas" style="z-index:1"></div>
                            <div id="calendar-overlay" class="active"></div>

                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>


    <div id="modal-reserva" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reservar salão</h4>
                </div>
                <div class="modal-body">
                    <form class="row" method="post">
                        <input type="hidden" name="id_reserva" value="">
                        <div class="mb-md-2">
                            <div class="col-md-6 mb-sm-2 mb-md-0">
                                <label>Responsável</label>
                                <select name="id_responsavel" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="" selected="selected">Selecione um responsável</option>
                                    <?php foreach ($usuarios as $usuario): ?>
                                        <option value="<?php echo $usuario["id_pessoa"] ?>"><?php echo $usuario["nome"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-sm-2 mb-md-0">
                                <label>Salão</label>
                                <select name="id_unidade" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                    <option value="" selected="selected">Selecione um salão</option>
                                    <?php foreach ($saloes as $salao): ?>
                                        <option value="<?php echo $salao["id_unidade"] ?>"><?php echo $salao["numero"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label>Valor</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="valor" value="" required>
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>

                        <div class="mb-md-2">
                            <div class="col-md-6 mb-sm-2 mb-md-0">
                                <label>Horário início</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="datetime-local" class="form-control pull-right" id="data_inicio" name="data_inicio" required>
                               </div>
                           </div>

                            <div class="col-md-6 mb-sm-2 mb-md-0">
                                <label>Horário Fim</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="datetime-local" class="form-control pull-right" id="data_fim" name="data_fim" required>
                               </div>
                           </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="salvar-reserva" class="btn btn-primary">Salvar</button>
                </div>
                </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 Seu Geraldo.</strong> All rights reserved.
    </footer>
<style media="screen">
    #calendar-overlay {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        opacity: 0;
        background-color: #000;
        transition: opacity 0.25s ease, z-index 0 linear 0.25s;
        z-index: -9999;
        will-change: opacity;
    }

    #calendar-overlay.active {
        z-index: 2;
        opacity: 0.3;
    }
</style>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
    $(function () {
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()


        var today = new Date(y, m, d);
        var tomorrow = new Date(y, m, d + 1);
        var modal = $("#modal-reserva");
        var calendarOverlay = $("#calendar-overlay");
        var registrarReserva = $("#registrar-reserva");


        registrarReserva.on("click", function () {
            formReservaVaga();
            modal.modal("show");
        });

        $("#editar-reservas").on("click", function () {
            calendarOverlay.toggleClass("active");
        })

        modal.find("input[name=valor]")

        function formReservaVaga ( id_usuario, id_salao, valor, data_inicio, data_fim, id_reserva ) {

            var usuarios = modal.find("select[name=id_responsavel]");
            var saloes = modal.find("select[name=id_unidade]");

            saloes.val(id_salao).trigger("change");

            usuarios.val(id_usuario).trigger("change");

            modal.find("input[name=id_reserva]").val( id_reserva ? id_reserva : "");
            modal.find("input[name=valor]").val( valor ? valor : "");
            modal.find("input[name=data_inicio]").val( data_inicio ? data_inicio : "");
            modal.find("input[name=data_fim]").val( data_fim ? data_fim : "");

        }


        $('#calendario-reservas').fullCalendar({
            monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Set", "Out", "Nov", "Dez"],
            dayNames: ["Domingo","Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sabádo"],
            dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
          header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week : 'Semana',
            day  : 'Dia'
          },
          //Random default events
          events    : <?php echo $data ?>,
        eventAfterRender: function ( event, element ) {
            var container = $(document.createElement("div"));
            var removerButton = $(document.createElement("button")).css({background: "none", border: "none", marginRight: "3px", marginLeft: "3px"}) ;
            var editarButton = $(document.createElement("button")).css({background: "none", border: "none", marginRight: "3px", marginLeft: "3px"}) ;

            container.append(editarButton, removerButton).css({"float": "right"});

            editarButton.on("click", function (e) {
                e.stopPropagation();
                e.preventDefault();

                formReservaVaga(event.id_pessoa, event.id_unidade, event.valor, event.data_inicio, event.data_fim, event.id_unidade_reserva);

                modal.modal('show');

            }).append($(document.createElement("i")).addClass("fa").addClass("fa-pencil")).addClass("button");



            removerButton.on("click", function (e) {
                e.stopPropagation();
                e.preventDefault();

                $.ajax({
                    method: "post",
                    dataType: "json",
                    data: {
                        id_unidade_reserva: event.id_unidade_reserva,
                        action: "remover"
                    },
                    success: function ( response ) {
                        if ( response.success ) {
                            alert("Evento deletado com sucesso");
                            modal.modal("hide");
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }).append($(document.createElement("i")).addClass("fa").addClass("fa-times")).addClass("button")
            element.find('.fc-content').append(container)
        },
          editable  : true,
          droppable : true, // this allows things to be dropped onto the calendar !!!
          drop      : function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject')

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject)

            // assign it the date that was reported
            copiedEventObject.start           = date
            copiedEventObject.allDay          = allDay
            copiedEventObject.backgroundColor = $(this).css('background-color')

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)

            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove()
            }

          }
      });

      $("#salvar-reserva").on("click", function () {
          var form = modal.find("form");
          var data = form.serializeArray();
          if ( form.find("input[name=id_reserva]").val()) {
              data.push({
                  name: "action",
                  value: "editar"
              });
          }

          $.ajax({
              method: "post",
              dataType: "json",
              data: data,
              success: function ( response ) {
                  console.log('hi')
                  console.log(response);
                  if (response.success) {
                      alert("Reserva cadastrada");
                      modal.modal("hide");
                      location.reload();
                  } else {
                      alert(response.message);
                  }
              }
          })
      });

        var events = $('#calendario-reservas').fullCalendar("clientEvents");

        for ( var i = 0; i < events.length; i++ ) {
            if ( events[i].start._d.getTime() >= today.getTime() && ( events[i].end == null || events[i].end._d.getTime() <= tomorrow.getTime()) ) {
                events[i].backgroundColor = "#00a65a";
                events[i].borderColor = "#00a65a";
            } else if (events[i].start._d.getTime() < today.getTime()) {
                events[i].backgroundColor = "#a0a0a0";
                events[i].borderColor = "#a0a0a0";
            } else {
                events[i].backgroundColor = "#00c0ef";
                events[i].borderColor = "#00c0ef";
            }
        }

        $('#calendario-reservas').fullCalendar("updateEvents", events);

        // console.log($('#calendario-reservas').fullCalendar("clientEvents", function () {
        //     console.log(arguments)
        // }))


        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
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


    })
</script>

</body>
</html>
