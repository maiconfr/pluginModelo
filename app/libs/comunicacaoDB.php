<?php

/**
 *
 */
class ComunicacaoDB
{
  private $DbName = "filainte_sistema";
  private $DbHost = "doutorpopular.com.br";
  private $DbUser = "filainte_sistema";
  private $DbPass = "0Qv@DtsG?@6b";
/*
  private $DbName = "relatoriosdrpop";
  private $DbHost = "localhost";
  private $DbUser = "root";
  private $DbPass = "";
*/
  function __construct()
  {
    $this->conectaDB();
    $this->conn->set_charset("utf8");
  }

  function estaConectado(){
    $this->conectaDB();
    if ($this->conn->connect_error) {
      return false;
    }
    return true;
  }

  private function conectaDB(){
    $mysqli = new mysqli($this->DbHost, $this->DbUser, $this->DbPass);
    $mysqli->select_db($this->DbName);
    $mysqli->set_charset("utf8");
    $this->conn = $mysqli;
  }

   function insert($tabela,$colunas,$valores){
    $this->conectaDB();
    foreach ($valores as $key => $value) {
      //esta função protege de sql inject
      $valores[$key] = $this->conn->real_escape_string($value);
    }

    $colunasComVirgulas = implode(", ",$colunas);
    $valoresComVirgulas = '"'.implode("\", \"",$valores)."\"";

    $sql = "INSERT INTO ".$this->conn->real_escape_string($tabela)." (".$colunasComVirgulas.")
    VALUES (".$valoresComVirgulas.");";

    if ($this->conn->query($sql) === TRUE) {
      $this->conn->close();
      return true;
    } else {
      $erro = $this->conn->error;
      $this->conn->close();
      return $erro;
    }

  }

  function limpaValor($valor){
    $limpo = $this->conn->real_escape_string($valor);

    return $limpo;
  }
  function limpaArray($array){

    $myArray = array_map('mysqli_real_escape_string', $this->conn, array_fill(0, count($array), $this->conn));
    return $myArray;
  }

  function select($sql){

    $this->conectaDB();
    $resultado = $this->conn->query($sql);
    if($resultado)
    $resultado = $resultado->fetch_all(MYSQLI_ASSOC);
    $this->conn->close();
    return $resultado;
  }

  function update($tabela,$colunas,$valores,$condicao){
    $this->conectaDB();
    $set = "";
    $i= 0;
    foreach ($valores as $key => $value) {
      if ($i == 0){
        $set = $colunas[$i]."="."'".$value."'";
      }else{
        $set = $set.", ".$colunas[$i]."="."'".$value."'";
      }
      $i++;
    }

    $sql = "UPDATE ".$tabela."
            SET ".$set."
            WHERE ".$condicao;

        if ($this->conn->query($sql) === TRUE) {
      $this->conn->close();
      return true;
    } else {
      $this->conn->close();
      return false; //"Error updating record: " . $conn->error;
    }
  }
  function query($sql){
    $this->conectaDB();
    $resposta = $this->conn->query($sql);
    if ($resposta != 1){
      $this->error = $this->conn->error;
    }else{
      $this->error = "";
    }
    $this->conn->close();
    return $resposta;
  }


}
