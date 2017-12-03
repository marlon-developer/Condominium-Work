<?php
    /**
     * Created by PhpStorm.
     * User: Eric
     * Date: 17/11/2017
     * Time: 00:45
     */
    class DataBase {

    }

    //Apagar registros da tabela
    function DBDelete($table,$where = null){
        //$table = DB_PREFIX . '_' . $table;
        $where = ($where) ? " {$where}" : null;

        $query = "DELETE FROM {$table}{$where}";
        return DBExecute($query);
    }

//Alterar Registros em tabela
    function DBUpDate($table, array $data, $where = null){
        foreach ($data as $key => $value){
            $fields[] = "{$key} = '{$value}'";
        }
        $fields = implode(', ', $fields);

        //$table = DB_PREFIX . '_' . $table;

        $where = ($where) ? " WHERE {$where}" : null;

        $query = "UPDATE{$table} SET{$fields} WHERE{$where}";
        return DBExecute($query);
    }

//Ler Registros
    function DBRead($table, $params = null, $fields = '*'){
        //$table = DB_PREFIX . '_' . $table;
        $params = ($params) ? " {$params} " : null;//se tiver parâmetros será informado ' {$parâmetros}' senão recebe null

        $query = "SELECT {$fields} FROM {$table}{$params}";
        $result = DBExecute($query);

        if (!mysqli_num_rows($result)){//verifica se há registros na tabela e mostra o numero de linhas do SELECT
            return false;
        }else{
            while($res = mysqli_fetch_assoc($result)){//transforma os campos de uma tabela em um array onde os nomes dos campos serão os índices.
                $data[] = $res;
            }
            return $data;
        }
    }

//Gravar registros
    function DBCreate($table, array $data){
        //$table = DB_PREFIX . '_' . $table;
        //$data = DBEscape($data);

        $fields = implode(', ', array_keys($data));
        $values = "'" . implode("', '", $data) . "'";

        $query = "INSERT INTO {$table} ({$fields}) VALUES({$values})";
        return DBExecute($query);
    }

//executa Querys
    function DBExecute($query){
        $link = DBConnect();
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));

        DBClose($link);

        return $result;
    }