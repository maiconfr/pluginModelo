<?php

/**
 *
 */
class ModelLogin
{
  private $tabelaUsuario = "usuarios";
  private $sessionLogin;

  function __construct()
  {
    $this->modelSession = new LibSession;
  }

  function conectaUsuario($usuario, $senha){
    $conn = new ComunicacaoDB;
    $usuario = $conn->limpaValor($usuario);
    $senha = md5($senha);
    $query = "SELECT * FROM ".$this->tabelaUsuario." WHERE email='".$usuario."' AND senha='".$senha."'";
    $resposta = $conn->select($query);

    if(count($resposta)>0){
      $this->modelSession;
      $arraySession = array(
        "email" => $usuario,
        "loginGoogle" => false,
        "permissao" => $resposta[0]["permissao"],
        "usuarioId" =>$resposta[0]["id"],
        "expiraEm" => strtotime("+ 1 day")
      );
      $arraySession = json_encode($arraySession);
      $this->modelSession->setSession("login", $arraySession);
      return true;
    }
    else{
      return false;
    }
  }

  function logout(){
      $this->modelSession;
      $this->modelSession->removeSession('login');
  }

  function estaLogado(){
    $this->modelSession;
    $this->sessionLogin = json_decode($this->modelSession->getSession("login"), true);

    if(!isset($this->sessionLogin)) return false;
    $tempoAtual = strtotime("now");
    if((int)$this->sessionLogin["expiraEm"] <= (int)$tempoAtual) return false;
    return true;
  }

  function getEmail(){
    if($this->estaLogado()){
      return $this->sessionLogin["email"];
    }
    return false;
  }

  function getUsuarioId(){
    if($this->estaLogado()){
      return $this->sessionLogin["usuarioId"];
    }
    return false;
  }

  function getUsuarioPermissao(){
    if($this->estaLogado()){
      return $this->sessionLogin["permissao"];
    }
    return false;
  }

  function verificaSenha($senha){
    $db = new ComunicacaoDB;
    $sql = "SELECT * FROM ".$this->tabelaUsuario." WHERE id = ".$this->getUsuarioId();
    $resposta = $db->select($sql);
    if(isset($resposta[0])){
      if(md5($senha) == $resposta[0]["senha"]) return true;
    }
    return false;
  }

  function atualizaSenha($senha){
    $db = new ComunicacaoDB;
    $db->update($this->tabelaUsuario, array("senha"), array(md5($senha)), "id = ".$this->getUsuarioId());
  }
}
