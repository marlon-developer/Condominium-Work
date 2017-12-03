<?php
    /**
     * Created by PhpStorm.
     * User: Eric
     * Date: 23/11/2017
     * Time: 20:45
     */

    class ReceitasDespesas {
        public $recDesp;
        public $unidade;
        public $unRepCond;
        public $valor;
        public $classificacao;
        public $referencia;
        public $cobranca;
        public $pagamento;

        public function getRecDesp() {
            return $this->recDesp;
        }

        public function setRecDesp($recDesp) {
            $this->recDesp = $recDesp;
        }

        public function getUnidade() {
            return $this->unidade;
        }

        public function setUnidade($unidade) {
            $this->unidade = $unidade;
        }

        public function getUnRepCond() {
            return $this->unRepCond;
        }

        public function setUnRepCond($unRepCond) {
            $this->unRepCond = $unRepCond;
        }

        public function getValor() {
            return $this->valor;
        }

        public function setValor($valor) {
            $this->valor = $valor;
        }

        public function getClassificacao() {
            return $this->classificacao;
        }

        public function setClassificacao($classificacao) {
            $this->classificacao = $classificacao;
        }

        public function getReferencia() {
            return $this->referencia;
        }

        public function setReferencia($referencia) {
            $this->referencia = $referencia;
        }

        public function getCobranca() {
            return $this->cobranca;
        }

        public function setCobranca($cobranca) {
            $this->cobranca = $cobranca;
        }

        public function getPagamento() {
            return $this->pagamento;
        }

        public function setPagamento($pagamento) {
            $this->pagamento = $pagamento;
        }

        public function insereReceitaDespesa( $tipo, $id_unidade, $id_responsavel, $id_condominio, $id_categoria,$id_conta_bancaria,
                                             $valor, $classificacao, $ano_mes_referencia, $data_cobranca, $data_pagamento){
            $query = new Connection();
            $arrDados = array(
                'tipo'              => $tipo,
                'id_unidade'        => $id_unidade,
                'id_responsavel'    => $id_responsavel,
                'id_condominio'     => $id_condominio,
                'id_categoria'      => $id_categoria,
                'id_conta_bancaria' => $id_conta_bancaria,
                'classificacao'     => $classificacao,
                'valor'             => $valor,
                'ano_mes_referencia'=> $ano_mes_referencia,
                'data_cobranca'     => $data_cobranca,
                'data_pagamento'    => $data_pagamento,
            );
            $insereCategoria = $query->DBCreate('conta', $arrDados);
            var_dump($insereCategoria);
            if ($insereCategoria){
                echo "Dados inseridos com sucesso";
            }else {
                echo "Erro";
            }
        }
    }