<?php  	

	require 'Connection.php';
  $db = new Connection();

	/*if (isset($_POST['id_condominio'])) 
	if (isset($_POST['nome'])) 
	if (isset($_POST['tipo']))  
	if (isset($_POST['id_pessoa'])) 
	if (isset($_POST['numero_garagens'])) 
	if (isset($_POST['numero_quartos'])) 
	if (isset($_POST['area'])) 
	if (isset($_POST['valor_fracao_ideal'])) 
	if (isset($_POST['id_bloco'])) */

	$pessoa = array(
    'id_condominio'  => $_POST['condominio'],
    'id_bloco'			 => $_POST['bloco'],
    'id_unidade'		 => $_POST['unidade'],
    'nome'           => $_POST['nome'],
    'rg'             => $_POST['rg'],
    'cpf'            => $_POST['cpf'],
    'residencial'    => $_POST['residencial'],
    'celular'        => $_POST['celular'],
    'email'			     => $_POST['email']
  );


  $inserir_condominio = $db->DBCreate('pessoa', $pessoa);
  
  if ($inserir_condominio) {
  	echo "OK";
  	header("location: ../index.html");
  }


  else echo ":/";

  	

?>