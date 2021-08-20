<?php
//auto load
$ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
if($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "server.indoortech.com.br:8081"){
  define("URLBASE", $ssl."://".$_SERVER['HTTP_HOST']."/filaInteligente/");
}else{
  define("URLBASE", $ssl."://".$_SERVER['HTTP_HOST']."/");
}
define("DIRBASE", __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..");
include "app/libs/functions.php";

date_default_timezone_set("America/Sao_Paulo");
spl_autoload_register(function ($class_name) {
  $caminho = "app/libs/".$class_name . '.php';
  if (file_exists($caminho))
    include $caminho;

  $caminho = "app/models/".$class_name . '.php';
  if (file_exists($caminho))
    include $caminho;
/*
  $caminho = "app/controllers/".$class_name . '.php';
  if (file_exists($caminho))
    include $caminho;
*/
});

//roteamento
include "app/controllers/Pagina.php";
if (isset($_GET['url'])){
  $url = $_GET['url'];
  $url = rtrim($url,'/');
  $url = explode('/',$url);
  //print_r($url);
  //debug("<br>". $_GET['url']."<br>");
  $file = "app/controllers/paginas/".strtolower($url[0]).".php";
  //debug( $file."<br>");
  if (file_exists($file))
    include $file;
    if (class_exists($url[0])){
      $PageController = new $url[0];
  }
  else{
    include "app/controllers/paginas/Pagina404.php";
    $PageController = new Pagina404;
  }
}else{
  include "app/controllers/paginas/Home.php";
  $PageController = new Home;
}

function bodyDaPagina(){
  global $PageController, $url;

  switch ((is_array($url))?count($url):0) {
    case 2:
      if (method_exists($PageController,$url[1])){
        call_user_func_array(array($PageController, $url[1]), array());
      }
      else{
      aplica404();
      $PageController->body();
      }
      break;
      case 3:
      if (method_exists($PageController,$url[1])){
        call_user_func_array(array($PageController, $url[1]), array($url[2]));
      }
      else{
      aplica404();
      $PageController->body();
      }
      break;
      case 4:
      if (method_exists($PageController,$url[1])){
        call_user_func_array(array($PageController, $url[1]), array($url[2],$url[3]));
      }
      else {
      aplica404();
      $PageController->body();
      }
      break;
      case 5:
      if (method_exists($PageController,$url[1])){
        call_user_func_array(array($PageController, $url[1]), array($url[2],$url[3],$url[4]));
      }
      else {
      aplica404();
      $PageController->body();
      }
      break;

    default:
      $PageController->body();
      break;
  }
}
function aplica404(){
  global $PageController;
  include "app/controllers/paginas/Pagina404.php";
  $PageController = new Pagina404;
}
