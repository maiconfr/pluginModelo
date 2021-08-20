<?php

/**
*
*/
class Painel extends Pagina
{
  private $emailUsuario;
  private $modelLogin;
  private $modelPainel;
  private $idDoUsuario;
  private $nomeUsuario;
  private $permissaoUsuario;
  private $listaDeFuncionarios;
  private $listaDeEmpresas;
  private $perfilFuncionario;
  private $arrayMenus;

  function __construct()
  {
    $this->modelLogin = new ModelLogin;
    $logado = $this->modelLogin->estaLogado();
    $this->idDoUsuario = $this->modelLogin->getUsuarioId();
    $this->permissaoUsuario = $this->modelLogin->getUsuarioPermissao();
    if(!$logado){
      header("Location: ".URLBASE."login");
    }

    $this->modelPainel = new ModelPainel($this->idDoUsuario, $this->permissaoUsuario);
  }

  function header(){
    $this->arrayMenus = $this->modelPainel->getMenu();
    require_once("app/views/painel/headerPainel.php");
  }

  function body(){
    echo "<div class='container'>Painel aqui</div>";
  }

  function configuracoes(){
    addJSFooter("painel/telaConfigsEmpresa");

    if(isset($_POST["novaSenha"])){
      $senhaAtual = $this->modelLogin->verificaSenha($_POST["senhaAtual"]);

      if($senhaAtual){
        if($_POST["novaSenha"] != "") $this->modelLogin->atualizaSenha($_POST["novaSenha"]);
      }else{
        $this->mensagemErro = "Senha atual incorreta";
      }
    }
    require_once("app/views/painel/configuracoesEmpresas.php");
  }

  function exibeErro(){
    if(isset($this->mensagemErro)) require_once("app/views/elementos/erroLogin.php");
  }

  function fila($idFila=0){
    if (isset($_POST["novoWhatsFila"])){
    $whatsapp = $_POST["novoWhatsFila"];
    $agente = $_POST["nomeAtendente"];

    $model = new ModelFila;
    $model->adicionaAgente($agente, $whatsapp,$this->idDoUsuario,$idFila);

    }

    require_once("app/views/fila.php");
  }

}
