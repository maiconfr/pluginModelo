<?php


/**
 *
 */
abstract class Pagina
{

  function __construct()
  {

  }

  function header(){
    //header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    //header("Cache-Control: post-check=0, pre-check=0", false);
    //header("Pragma: no-cache");
    require_once("app/views/header.php");
  }

  function footer(){
    require_once("app/views/footer.php");
  }

  abstract function body();
}
