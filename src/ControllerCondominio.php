<?php 
	

	include ("Condominio.php");



	$cond = new Condominio();

	$action = $_POST['action'];

	$cond->setNome($_POST['nome']);
	$cond->setCep($_POST['cep']);
	$cond->setLogradouro($_POST['logradouro']);
	$cond->setEndereco($_POST['endereco']);
	$cond->setComplemento($_POST['complemento']);
	$cond->setEstado($_POST['estado']);
	$cond->setCidade($_POST['cidade']);
	$cond->setCnpj($_POST['cnpj']);
	$cond->setTotalUnidades($_POST['totalUnidades']);
	$cond->setResponsavel($_POST['responsavel']);
	$cond->setTelefone($_POST['telefone']);
	$cond->setAreaTotal($_POST['areaTotal']);
	$cond->setAreaTotalConstruida($_POST['areaTotalConstruida']);

	switch($action){
		case 'add':
			$cond->Adicionar();
			break;
		case 'edit':
			$cond->Editar($_POST('id'));
			break;
		case 'delete':
			$cond->Excluir($_POST('id'));
			break;
		case 'list':
			$cond->Listar();
			break;
	}
 ?>