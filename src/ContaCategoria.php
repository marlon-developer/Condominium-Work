<?php
    /**
     * Created by PhpStorm.
     * User: Eric
     * Date: 19/11/2017
     * Time: 20:06
     */
    include_once 'Connection.php';

    class ContaCategoria {
        public $titulo;
        public $descricao;


        public function getDescricao() {
            return $this->descricao;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function insereConta($titulo, $descricao){
            $query = new Connection();
            $arrDados = array(
                'titulo'       => $titulo,
                'descricao'    => $descricao,
            );
            $query->DBCreate('conta_categoria', $arrDados);
        }
    }