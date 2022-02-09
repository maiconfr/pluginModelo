<?php


/**
 * Classe para extender as propriedades do arquivo principal
 */
class Pagina extends PluginModelo
{

  function __construct()
  {
    parent::__construct();
  }

  function header(){
    //require_once("app/views/header.php");
  }

  function footer(){
    //require_once("app/views/footer.php");
  }

}
