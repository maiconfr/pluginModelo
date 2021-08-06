<?php

/**
 *
 */
class ModelLogin
{
  private $tabelaUsuario = "usuarios";

  function __construct()
  {
    // code...
  }

  function conectaUsuario($usuario, $senha){
    $conn = new ComunicacaoDB;
    $usuario = $conn->limpaValor($usuario);
    $senha = md5($senha);
    $query = "SELECT * FROM ".$this->tabelaUsuario." WHERE email='".$usuario."' AND senha='".$senha."'";
    $resposta = $conn->select($query);

    if(is_array($resposta) && count($resposta)>0){
      $modelSession = new ModelSession;
      $arraySession = array(
        "email" => $usuario,
        "loginGoogle" => false,
        "permissao" => $resposta[0]["tipo_usuario_id"],
        "expiraEm" => strtotime("+ 7 day")
      );
      $arraySession = json_encode($arraySession);
      $modelSession->setSession("login", $arraySession);
      return true;
    }
    else{
      return false;
    }
  }
}
