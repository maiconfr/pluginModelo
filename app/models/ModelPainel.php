<?php

/**
 *
 */
class ModelPainel
{
  private $permissaoUsuario;

  function __construct($idDoUsuario, $permissaoUsuario)
  {
    $this->db = new ComunicacaoDB;
    $this->idDoUsuario =  $idDoUsuario;
    $this->permissaoUsuario = $permissaoUsuario;
  }

  function getMenu(){
    $resposta = array();
    $fila1 = array("icone" => "support_agent", "link" => URLBASE."painel/fila/1", "titulo" => "Fila 1");
    $fila2 = array("icone" => "support_agent", "link" => URLBASE."painel/fila/2", "titulo" => "Fila 2");
    $fila3 = array("icone" => "support_agent", "link" => URLBASE."painel/fila/3", "titulo" => "Fila 3");
    $fila4 = array("icone" => "support_agent", "link" => URLBASE."painel/fila/4", "titulo" => "Fila 4");
    $fila5 = array("icone" => "support_agent", "link" => URLBASE."painel/fila/5", "titulo" => "Fila 5");

    switch ($this->permissaoUsuario){
      case 1: //Perfil Empresa
      array_push($resposta, $fila1, $fila2, $fila3);
      return $resposta;
      break;
    }
  }
}
