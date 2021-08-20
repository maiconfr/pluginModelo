<?php

/**
 *
 */
class LibSession
{

  function __construct()
  {
    session_start();
  }

  function setSession($item, $valor){
    $_SESSION[$item] = $valor;
  }

  function getSession($item){
    return $_SESSION[$item];
  }

  function removeSession($item){
    unset($_SESSION[$item]);
  }
}
