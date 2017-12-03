<?php
$servername = "mysql02-farm70.uni5.net";
$username = "seugeraldo";
$pas = "sg2017";
$dbname= "seugeraldo";

$con = mysqli_connect($servername, $username, $pas, $dbname);

if (!$con) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
 
echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
 
/*
while($exibe = mysql_fetch_assoc($sql)){
  echo $exibe['nome'] .'<br>';
}
*/
 

$query = mysqli_query($con, "select email from pessoa");


?>


<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Gestor de condomínio</title>

    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">

        <section class="sidebar">

       

            <hr>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">HEADER</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
                <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>

    </aside>

    <div class="content-wrapper">

        <section class="content-header">

            <ol class="breadcrumb">

            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">


<div class="col-sm-6">

	<div class="box box-primary">
		<div class="box-header">
		<h5>Enviar Mensagem</a></h5>
		</div>
		<div class="box-body">
	
		<form method="post" id="formulario_contato" onsubmit="validaForm(); return false;" class="form">
			<p class="name">
				<label for="name">Nome</label>
				
				<input type="text" name="nome" id="nome" class="form-control" placeholder="Seu Nome" />
			</p>
			
			<p class="email">
				
				<div class="form-group">
                  <label for="email">Seleciona o E-mail</label> 

                  <select multiple="" class="form-control">
				  				  <?php
				   while($row = mysqli_fetch_assoc($query))
{	
?>
                   <option value="<?php echo $row['email'] ?>"> <?php echo $row['email'] ?> </option>
                 <?php } ?>
                  </select>

                </div>
				
			</p>		
		
			<p class="text">
				<label for="mensagem">Mensagem</label>
				<textarea name="mensagem" class="form-control" id="mensagem" placeholder="Escreva sua mensagem" /></textarea>
			</p>
			
			<p class="submit">
				<input class="btn btn-primary" type="submit" value="Enviar" />
				
			</p>
			
		</form>
		</div>
		
		</div>
		
        </section>
        <!-- /.content -->
    </div>
</div>
    <footer class="main-footer">
    </footer>

</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>

</html>
