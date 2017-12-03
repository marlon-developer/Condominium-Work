<?php  	

  //Estabelece uma conexão com o arquivo (Connection) para uma conexão com o banco de dados
	require 'Connection.php';

  //Cria um objeto com a classe Connection
  $db = new Connection();


  //Seta os dados dos campos do formulário no array $unidade
	$unidade = array(
    //'id_condominio'         => $_POST['condominio'], //Chave Estrangeira Com Problema
    'tipo'                  => $_POST['tipo'],
    'descricao'				      => $_POST['descricao'],
    'numero'				        => $_POST['numero'],
    'numero_garagens'       => $_POST['numero_garagens'],
    'numero_quartos'        => $_POST['numero_quartos'],
    'area'                  => $_POST['area'],
    'valor_fracao_ideal'    => $_POST['valor_fracao_ideal'],
    'id_bloco'              => $_POST['bloco']
    //'id_unidade_master'			=> $_POST['id_unidade'] //Comentando pois está dando erro de violação de chave estrangeira ao passar o parametro  
  );

  //Atribui a variável $inserir_unidade os dados passados para o método DBCreate da tabela unidade
  $unidade = $db->DBCreate('unidade', $unidade);

  //Se estiver tudo ok Redireciona para a página home
  if ($unidade) header("location: ../index.html");

  //Caso haja algum erro no meio do caminho ele redireciona para a página de cadastro novamente
  else header("location: AdicionarUnidade.php");




  //Seta os dados dos campos do formulário no array $unidade_pessoa
  /*$unidade_pessoa = array(
    //'id_condominio'            => $_POST['condominio'], //Chave Estrangeira Com Problema
    'id_pessoa'                => $_POST['pessoa'],
    'id_unidade'               => $_POST['unidade']
  );*/

  //Inserção Comentada pois apresenta erro e impede o funcionamento do resto

  //Atribui a variável $inserir_unidade os dados passados para o método DBCreate da tabela unidade
  //$unidade_pessoa = $db->DBCreate('unidade_pessoa' $unidade_pessoa);

  //Se estiver tudo ok Redireciona para a página home
  //if ($unidade && $unidade_pessoa) header("location: ../index.html");

  //Caso haja algum erro no meio do caminho ele redireciona para a página de cadastro novamente
  //else header("location: AdicionarUnidade.php");
?>