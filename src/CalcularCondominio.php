<?php

include("Connection.php");

Class CalcularCondominio extends {

	public function calcularCondominio($fundoReserva, $tipoCalculo){
		
			$fundoReserva = $_POST["fundoReserva"];
			$tipoCalculo = $_POST["tipoCalculo"];
			
			if ($tipoCalculo == "fracaoIdeal"){
				
				calculoFracao();
				
			}else{
				
				calculoUnidade();
				
			}

	public function calculoFracao(){
	}
	
	public function calculoUnidade(){
		
	}
	
	public function salvarValorCondominio(){
		
	}
	
}