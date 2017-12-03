<?php

include("Connection.php");

class ContaBancaria extends Connection
{

    public function add( $info ) {
        $objectConnection = new Connection;
        if(empty($info) ) {
            return true;
        }
        
        try {
            //function DBCreate($table, array $data){
            if ( !empty($info['statusInativo']) ) {
                unset($info['statusInativo']);
                $info['ativo'] = 0;
            } else {
                unset($info['statusAtivo']);
                $info['ativo'] = 1;  
            }

            $date = explode('/', $info['data_inicio']);
            $info['data_inicio'] = $date[2].'-'.$date[0].'-'.$date[1] ;
            $objectConnection->DBCreate('conta_bancaria', $info);
            
        } catch (Exception $e) {
            
        }

    	return true;
    }
      
    public function busca_dados( $id) {
    }
      
    public function delete( $id ) {
        $objectConnection = new Connection;
       if($objectConnection->DBDelete('conta_bancaria', 'id_conta_bancaria = '.$id)) {
            return true;
       } else {
            return false;
       }

    }
    
    public function edit( $info ) {
    }

    public function lista_dados() {
        $objectConnection = new Connection;

        $connection = $objectConnection->DBConnect();
        $result = $objectConnection->DBRead('conta_bancaria');
        return $result;
    }

}
