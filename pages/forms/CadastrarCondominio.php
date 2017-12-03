<?php
  require '../../src/Connection.php';
  $db = new Connection();
  
  //Query
  $codigo = $db->DBRead('pessoa', null , 'id_pessoa');
  $condominio = $db->DBRead('condominio', null , 'nome');
  $bloco = $db->DBRead('bloco', null , 'descricao');
  $unidade = $db->DBRead('unidade', null , 'descricao');
 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastrar Unidade</title>
</head>
<body>

<!-- Começa Aqui-->
<form method="POST" action="../../src/ClassCondominio.php">
  <div style="max-width: 1200px; margin: 0 auto; padding: 10px;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-6 col-xs-12 content">
          <h3></h3>

  <!--Campo Condomínio-->
  <div>
      Condomínio
      <select name="condominio">
        <?php 
          foreach ($condominio as $c) {
            echo "<option value='$c[id_condominio]'>".$c['nome']."</option>";
          }
        ?>
      </select>
  </div>


  <!--Campo Seleciona Bloco-->
  <div class="form-check">
    Bloco
    <select name="bloco" class="custom-select d-block my-3">
      <?php 
        foreach ($bloco as $b) {
          echo "<option value='$b[id_bloco]'>".$b['descricao']."</option>";
        }
      ?>
    </select>
  </div>  

  <!--Campo Seleciona Unidade-->
  <div class="form-check">
    Unidade
    <select name="unidade" class="custom-select d-block my-3">
        <?php 
          foreach ($unidade as $u) {
            echo "<option value='$u[id_unidade]'>".$u['descricao']."</option>";
          }
        ?>
    </select>
  </div> 


  <h3>Dados Pessoais do Condomino</h3>

   <!--Campo Código-->
  <div>
    Código<input type="text" placeholder="Código" name="codigo">
  </div>


  <!--Campo Nome-->
  <div>
    Nome <input type="text" placeholder="Nome" name="nome" required>
  </div>

  <!--Campo RG-->
  <div>
    RG <input type="text" placeholder="RG" name="rg" required>
  </div>

  <!--Campo CPF-->
  <div>
    CPF<input type="text" placeholder="CPF" name="cpf" required>
  </div>

  <!--Campo Telefone Residencial-->
  <div>
    Telefone Residencial <input type="text" placeholder="Telefone Residencial" name="residencial" required>
  </div>

  <!--Campo Celular-->
  <div>
    Celular<input type="text" placeholder="Celular" name="celular" required>
  </div>

  <!--Campo Email-->
  <div>
    Email <input type="text" placeholder="Email" name="email" required>
  </div>

  <button type="submit">Cadastrar</button>
  <button>Cancelar</button>

 
<!--Termina Aqui-->    
     </div>
      </div>
    </div>
  </div>
</form>
</body>

<script src="validar.js"></script>


</html>
