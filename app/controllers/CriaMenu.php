<?php

/**
 *
 */
class CriaMenu extends Pagina
{

  function __construct()
  {
    parent::__construct();
  }

  function menuConfiguracoes(){
    echo "Menu Modelo";
    return true;

  }
}
