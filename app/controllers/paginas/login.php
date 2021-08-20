<?php

/**
 *
 */
class Login extends Pagina
{
  private $menssagemErro = "";

  function __construct()
  {

  }

  function header(){
    require_once("app/views/header_login.php");
  }

  function footer(){
    addJSFooter("OAuthGoogle.js");
  }

  function body(){
    if(isset($_POST["usuario"])){
      $model = new ModelLogin;
      $resposta = $model->conectaUsuario($_POST["usuario"],$_POST["senha"]);
      if ($resposta != true) {
        $this->mensagemErro = "Login ou senha incorretos";
      }else{
        header("Location: ".URLBASE."painel");
      }
    }
    require_once("app/views/login.php");
  }

  function exibeErro(){
    if(isset($_POST["usuario"])){
      require_once("app/views/elementos/erroLogin.php");
    }
  }

  function logout(){
    $model = new ModelLogin;
    $model->logout();
    header("Location: ".URLBASE."login");
  }
}
