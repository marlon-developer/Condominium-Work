<?php
class Connection {
    private $host = "mysql02-farm70.uni5.net";
    private $user = "seugeraldo";
    private $passwd = "sg2017";
    private $dtname = "seugeraldo";
    private $conn;

    function DBClose($conn){
        @mysqli_close($conn) or die(mysqli_error($conn));
    }

    function DBEscape($dados){
        $link = DBConnect();
        if (!is_array($dados)){
            $dados = mysqli_real_escape_string($link, $dados);
        }else{
            $arr = $dados;

            foreach ($arr as $key => $value){
                $key = mysqli_real_escape_string($link, $key);
                $key = mysqli_real_escape_string($link, $value);

                $dados[$key] = $value;
            }
        }
        $this->DBClose($link);
        return $dados;
    }
    //Conexão com o banco
    function DBConnect() {
        try {
            $conn = new mysqli('mysql02-farm70.uni5.net', 'seugeraldo', 'sg2017', 'seugeraldo')
            or die ('Sem conexão ao servidor' . mysqli_connect_error());

            if ($conn->connect_error) {
                die("ERRO. " . $conn->connect_errno);
            } else {
                $conn;
            }

        } catch (PDOException $e) {
            echo 'Erro' . $e->getMessage();
        }
        return $conn;
    }

    //Apagar registros da tabela
    function DBDelete($table,$where = null){
        //$table = DB_PREFIX . '_' . $table;
        $where = ($where) ? " {$where}" : null;

        $query = "DELETE FROM {$table} WHERE {$where}";
        echo $query;
        return $this->DBExecute($query);
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
        return $this->DBExecute($query);
    }

//Ler Registros
    function DBRead($table, $params = null, $fields = '*'){
        //$table = DB_PREFIX . '_' . $table;
        $params = ($params) ? " {$params} " : null;//se tiver parâmetros será informado ' {$parâmetros}' senão recebe null

        $query = "SELECT {$fields} FROM {$table}{$params}";
        $result = $this->DBExecute($query);

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
        $fields = implode(', ', array_keys($data));
        $values = "'" . implode("', '", $data) . "'";
        $query = "INSERT INTO {$table} ({$fields}) VALUES({$values})";
        return $this->DBExecute($query);
    }

   

//executa Querys
    function DBExecute($query){
        $link = $this->DBConnect();
        $result = @mysqli_query($link, $query) or die(mysqli_error($link));

        $this->DBClose($link);

        return $result;
    }

}
    