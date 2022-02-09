<?php

/**
* Roteador para o modelo MVC integrado com
* o formato de plugin do Wordpress
*/
class RoteadorPluginModelo extends PluginModelo
{

  function __construct()
  {
    parent::__construct();
  }

  function redireciona($caminhoArray){
    $this->declaraAutoload();

    $controller = new $caminhoArray[0];

    switch (count($caminhoArray)) {
      case 2:
      return call_user_func_array(array($controller, $caminhoArray[1]), array());
      break;

      case 3:
      return call_user_func_array(array($controller, $caminhoArray[1]), array($caminhoArray[2]));
      break;

      case 4:
      return call_user_func_array(array($controller, $caminhoArray[1]), array($caminhoArray[2], $caminhoArray[3]));
      break;

      case 5:
      return call_user_func_array(array($controller, $caminhoArray[1]), array($caminhoArray[2], $caminhoArray[3], $caminhoArray[4]));
      break;

      default:
      // code...
      break;
    }
  }

  function declaraAutoload(){
    spl_autoload_register(function ($class_name) {
      $caminho = $this->caminhoModels.$class_name . '.php';
      if (file_exists($caminho)){
        include $caminho;
      }else{
        $caminho = $this->caminhoController.$class_name . '.php';
        if (file_exists($caminho))
        include $caminho;
      }
    });
  }
}
