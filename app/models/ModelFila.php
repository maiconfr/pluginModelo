<?php


/**
 *
 */
class ModelFila
{
  private $nomeTabelaAgentes = "agentes";
  private $nomeTabelaFilaConfig = "fila_config";

  function __construct()
  {
    $this->db = new ComunicacaoDB;
  }

  function adicionaAgente($agente, $whatsapp,$idDoUsuario,$idFila){
    $sql = "SELECT * from ".$this->nomeTabelaFilaConfig." WHERE id_fila = ".$idFila." AND id_usuario = ".$idDoUsuario;
    $resposta = $this->db->select($sql);

    if (!isset($resposta[0])){
      $coluna = array(
        'id_fila',
        'id_usuario',
        'posicao'
      );
      $dados = array(
        $idFila,
        $idDoUsuario,
        0
      );
      $idFilaDB = $this->db->insert($this->nomeTabelaFilaConfig,$coluna,$dados);
    }else{
      $idFilaDB = $resposta[0]['id'];
    }

    $coluna = array(
      'agente',
      'whatsapp',
      'id_fila'
    );
    $dados = array(
      $agente,
      $whatsapp,
      $idFilaDB,
    );

    $this->db->insert($this->nomeTabelaAgentes,$coluna,$dados);
  }
}
