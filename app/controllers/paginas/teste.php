<?php

/**
 *
 */
class Teste extends Pagina
{

  function __construct()
  {
    // code...
  }

  function body(){
    $modelDB = new ComunicacaoDB;
    echo $modelDB->insert("usuarios",array("email","senha"),array("teste@gmail.com",md5("1234")));

  }
}
