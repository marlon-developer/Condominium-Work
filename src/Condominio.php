<?php


	include_once("Connection.php");

	class Condominio{
		private $id = "", $codigo = "", $nome = "", $cep = "", $logradouro = "", $endereco = "", $complemento = "", $estado = "", $cidade = "", $cnpj = "", $totalUnidades = "", $responsavel = "", $telefone = "", $areaTotal = "", $areaTotalConstruida = "";



		/* GETS */

		function getId(){
			return $this->id;
		}
		function getNome(){
			return $this->nome;
		}
		function getCep(){
			return $this->cep;
		}
		function getLogradouro(){
			return $this->logradouro;
		}
		function getEndereco(){
			return $this->endereco;
		}
		function getComplemento(){
			return $this->complemento;
		}
		function getEstado(){
			return $this->estado;
		}
		function getCidade(){
			return $this->cidade;
		}
		function getCnpj(){
			return $this->cnpj;
		}
		function getTotalUnidades(){
			return $this->totalUnidades;
		}
		function getResponsavel(){
			return $this->responsavel;
		}
		function getTelefone(){
			return $this->telefone;
		}
		function getAreaTotal(){
			return $this->areaTotal;
		}
		function getAreaTotalConstruida(){
			return $this->areaTotalConstruida;
		}

		/* SETS */

		function setNome($nome){
			$this->nome = $nome;
		}
		function setCep($cep){
			$this->cep = $cep;
		}
		function setLogradouro($logradouro){
			$this->logradouro = $logradouro;
		}
		function setEndereco($endereco){
			$this->endereco = $endereco;
		}
		function setComplemento($complemento){
			$this->complemento = $complemento;
		}
		function setEstado($estado){
			$this->estado = $estado;
		}
		function setCidade($cidade){
			$this->cidade = $cidade;
		}
		function setCnpj($cnpj){
			$this->cnpj = $cnpj;
		}
		function setTotalUnidades($totalUnidades){
			$this->totalUnidades = $totalUnidades;
		}
		function setResponsavel($responsavel){
			$this->responsavel = $responsavel;
		}
		function setTelefone($telefone){
			$this->telefone = $telefone;
		}
		function setAreaTotal($areaTotal){
			$this->areaTotal = $areaTotal;
		}
		function setAreaTotalConstruida($areaTotalConstruida){
			$this->areaTotalConstruida = $areaTotalConstruida;
		}

		/* MÉTODOS DA CLASSE */

// -------------------- ADICIONAR -------------------- 
		
		public function Adicionar(){
			$mysql = Connection::DBConnect();
			try{
				
				$mysql->query("INSERT INTO condominio (nome, cep, logradouro, endereco, complemento, estado, cidade, cnpj, numero_total_unidades, responsavel, telefone, area_total, area_total_construida) values ('{$this->nome}', '{$this->cep}', '{$this->logradouro}', '{$this->endereco}', '{$this->complemento}', '{$this->estado}', '{$this->cidade}', '{$this->cnpj}', '{$this->totalUnidades}', '{$this->responsavel}', '{$this->telefone}', '{$this->areaTotal}', '{$this->areaTotalConstruida}');");
				//CODIGO PARA DEBUGAR A QUERY
				/*if ($mysql->error) {
					die($mysql->error);
				}*/
			}catch(Exception $e){
				echo 'Erro' . $e->getMessage();
			}
		}

// -------------------- LISTAR -------------------- 

		public function Listar(){
			$mysql = Connection::DBConnect();
			$dados = [];
			try{
				$condominios = $mysql->query("SELECT c.*, p.nome as nomeResponsavel FROM condominio c
											inner join pessoa p on p.id_pessoa = c.responsavel");
				while($row = mysqli_fetch_assoc($condominios)){
					$dados[] = $row;
				}
			}catch(Exception $e){
				echo 'Erro' . $e->getMessage();
			}
			return $dados;
		}

// -------------------- EDITAR -------------------- 

		public function Editar($id){
			$mysql = Connection::DBConnect();
			try{
				
				$mysql->query("UPDATE condominio SET (nome, cep, logradouro, endereco, complemento, estado, cidade, cnpj, numero_total_unidades, responsavel, telefone) values ('{$this->nome}', '{$this->cep}', '{$this->logradouro}', '{$this->endereco}', '{$this->complemento}', '{$this->estado}', '{$this->cidade}', '{$this->cnpj}', '{$this->totalUnidades}', '{$this->responsavel}', '{$this->telefone}', '{$this->areaTotal}', '{$this->areaTotalConstruida}') WHERE id_condominio = {$this->id};");
			}catch(Exception $e){
				echo 'Erro' . $e->getMessage();
			}
		}


// -------------------- EXCLUIR -------------------- 

		public function Excluir($id){
			$mysql = Connection::DBConnect();
			try{
				
				$mysql->query("DELETE FROM condominio WHERE id_condominio = {$this->id};");
			}catch(Exception $e){
				echo 'Erro' . $e->getMessage();
			}
		}

// -------------------- LISTAR CONDÔMINOS -------------------- 
	
	public static function ListarCondominos(){
		$mysql = Connection::DBConnect();
		$dados = [];
		try{
			$condominios = $mysql->query("SELECT p.id_pessoa, p.nome, c.id_condominio FROM pessoa p
										inner join condominio c on c.id_condominio = p.id_condominio;");
			while($row = mysqli_fetch_assoc($condominios)){
				$dados[] = $row;
			}
		}catch(Exception $e){
			echo 'Erro' . $e->getMessage();
		}
		return $dados;			
		}	
	}




	
	
 ?>