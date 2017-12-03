<?php
  include ("conexao.php");
  $db = new Data_Base;
  $db->conectar();
  $db->selecionarBanco();

  $db->consultar_condomino();


  echo $db->conectar();
  echo $db->selecionarBanco();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastrar Unidade</title>
</head>
<body>

<!-- Começa Aqui-->
<form method="post" action="cadastrar_condominio.php">
  <div style="max-width: 1200px; margin: 0 auto; padding: 10px;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-6 col-xs-12 content">
          <h3></h3>

  <!--Campo Condomínio-->
  <div>
      Condomínio
      <select>
        <?php $db->consultar_condominio();?>
      </select>
  </div>

  <!--Campo Tipo de Unidade-->
  <div>
    Tipo de Unidade<input type="text" name="tipo" required>
  </div>
  
  <!--Campo Para Locação da Unidade-->
  <div class="form-check">
    Pode Ser Locado<input type="checkbox" name="locacao" class="form-check-input" checked="true"> 
  </div>

  <?php 
      var_dump($db);
      

      foreach ($db as $cond) {
          echo "<option value=\"".$cond["id_pessoa"].">". $cond['nome'] ."</option>";
      }

      ?>

  <!--Campo Condômino-->
  <div class="form-check">
    Condômino
    <select>

    </select>
  </div>

  <!--Campo Número de Garagens-->
  <div class="form-check">
    Número de Garagens
      <select class="custom-select d-block my-3" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
  </div>

  <!--Campo Número de Quartos-->
  <div class="form-check">
      Número de Quartos
      <select class="custom-select d-block my-3" required>
        <option value="1">1</option>
        <option value="3">2</option>    
        <option value="3">3</option>
        <option value="4">4</option> 
        <option value="5">4</option>    
      </select>
  </div>

  <!--Campo Área-->
  <div class="form-check">
    Área (M) <input type="text" class="form-check-input" required>
  </div>

  <!--Campo Fração Ideal-->
  <div class="form-check">
    Fração Ideal (R$) <input type="text" class="form-check-input" required>
  </div>

  <!--Campo Verifica se pertence a outra Unidade-->
  <div class="form-check">
    Pertence a Outra Unidade <input type="checkbox" class="form-check-input" required>
  </div>

  <!--Campo Seleciona Unidade-->
  <div class="form-check">
    <select class="custom-select d-block my-3" required>
        <option name="unidade"><?php $db->consultar_unidade();?></option>  
    </select>
  </div>  

   <!--Campo Verifica se pertence a algum Bloco-->
  <div class="form-check">
    Pertence a Algum Bloco <input type="checkbox" class="form-check-input" required>
  </div>

 <!--Campo Seleciona Bloco-->
  <div class="form-check">
    <select class="custom-select d-block my-3" required>
      <?php $db->consultar_bloco();?> 
    </select>
  </div>  

  <button>Cancelar</button>
  <button type="reset">Limpar Dados</button>
  <button type="submit">Cadastrar</button>
 
<!--Termina Aqui-->    
     </div>
      </div>
    </div>
  </div>
</form>
  <script src="arq.js"></script>
</body>
</html>
