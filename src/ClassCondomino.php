<?php  	

	require 'Connection.php';
  $db = new Connection();


	$pessoa = array(
    'id_condominio'           => $_POST['condominio'],
    'id_bloco'			          => $_POST['bloco'],
    //'id_unidade'		        => $_POST['unidade'],
    'nome'                    => $_POST['nome'],
    'rg'                      => $_POST['rg'],
    'cpf'                     => $_POST['cpf'],
    'telefone_residencial'    => $_POST['residencial'],
    'telefone_celular'        => $_POST['celular'],
    'email'			              => $_POST['email']
    //'responsavel'           => $_POST['responsavel']
    //'rg_orgao_emissor'      => $_POST['rg_orgao_emissor']
  );


  $inserir_condomino = $db->DBCreate('pessoa', $pessoa);
  
  if ($inserir_condomino) header("location: ../index.html");
  else echo ":/";
?>