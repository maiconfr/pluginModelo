<?php
/*
* @pachage PluginModelo
* Plugin Name: Plugin Modelo
* Plugin URI: https://indoortech.com.br/
* Description: Este é um plugin de produção independente desenvolvido pela Indoor Tech ...
* Version: 1.0.0
* Author: Indoor Tech
* Author URI: https://indoortech.com.br/
* License: GPLV2
* Text Domain: PluginModelo
* Update URI: https://indoortech.com.br/itPanel/api/
*/

defined('ABSPATH') or die("Acesso Negado");

require_once(__DIR__.DIRECTORY_SEPARATOR."roteador.php");

if (!class_exists('IndoorTechAtualizacao'))
require_once(__DIR__.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."libs".DIRECTORY_SEPARATOR."updateClass.php");
/**
 *
 */
class PluginModelo //extends IndoorTechAtualizacao
{
  public $dbConfig = "";
  public $roteador;

  public $root = __DIR__;
  public $caminhoViews;
  public $caminhoPublic;
  public $caminhoController;
  public $caminhoModels;
  public $urlPlugin;
  public $versaoScript = "1.0";



function __construct()
{
  $this->caminhoViews = $this->root.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR;
  $this->caminhoPublic = $this->root.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR;
  $this->caminhoModels = $this->root.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR;
  $this->caminhoController = $this->root.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR;
  $this->urlPlugin = plugin_dir_url(__FILE__);
}

  function ativar(){
    global $wpdb;
    $wpdb_collate = $wpdb->collate;

    /* Adiciona regras para usuários

    add_role( 'paciente', 'Paciente', array( ));
    add_role('Atendente_RC', __( 'Atendente' ), array('read'=>true));
    */

    /* Criar tabela SQL na ativação do plugin

    if (! function_exists("maybe_create_table"))
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $tableName = $wpdb->prefix.$this->dbConfig;
    $createSQL = "CREATE TABLE {$tableName} (
      `id` INT unsigned NOT NULL auto_increment ,
      `nomeConfig` TEXT NOT NULL ,
      `tipoConfig` TEXT NOT NULL ,
      `valorConfig` TEXT NOT NULL ,
      `dataInsert` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      PRIMARY KEY (`id`)
    );
    COLLATE {$wpdb_collate}";
    dbDelta( $createSQL );
    */
  }

  function aoAtualizar(){
    $this->ativar();
  }

//Adiciona menu do plugin no painel adm
  function declararMenu(){
    $page_title = "Plugin Modelo";
    $menu_title = "Plugin Modelo";
    $capability = "administrator";
    $menu_slug = "plugin-modelo";
    $function = array($this, "criaMenu");
    $icon_url = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5NzkuOTkgOTI2LjI5Ij48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6I2YwZjBmMTt9PC9zdHlsZT48L2RlZnM+PGcgaWQ9IkNhbWFkYV8yIiBkYXRhLW5hbWU9IkNhbWFkYSAyIj48ZyBpZD0iQ2FtYWRhXzEtMiIgZGF0YS1uYW1lPSJDYW1hZGEgMSI+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTUwLDMuNjhDMTQwLjU2LDgsMTI5LjMyLDE5LjgyLDEyNy4wNywyOGMtMSwzLjA3LTEuNjMsMjQuNzMtMS42Myw0OC40MywwLDQwLjY2LjIsNDMuMzIsNC43LDUxLjUsMi40NSw0LjksOC4zOCwxMS4yNCwxMy4wOCwxNC4zLDcuMzYsNC45LDEwLjYzLDUuNzIsMjMuMDksNS43MnMxNS45NC0uODIsMjIuODktNS41MmEzNywzNywwLDAsMCwxMi42Ny0xNC43MWM0LjI5LTguNTgsNC41LTExLjI0LDMuODgtNTZsLS42MS00Ny02LjMzLThDMTg2LjU0LDEuMjMsMTY2LjcyLTQuMDgsMTUwLDMuNjhaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNjUxLjYyLDQuM0M2NDYuNzEsNyw2MzkuNzcsMTIuNDcsNjM2LjUsMTYuNzZsLTYuMzMsOC0uNjEsNDdjLS42MSw0NC43NS0uNDEsNDcuNDEsMy44OCw1NmEzNywzNywwLDAsMCwxMi42NywxNC43MWM2Ljk1LDQuNywxMC40Miw1LjUyLDIyLjg5LDUuNTJzMTUuNzMtLjgyLDIzLjA5LTUuNzJjNC43LTMuMDcsMTAuNjMtOS40LDEzLjA4LTE0LjMsNC41LTguMTcsNC43LTEwLjgzLDQuNy01MS41LDAtMjMuNy0uNjEtNDUuMzYtMS42My00OC40M0M3MDYsMTkuODMsNjk0Ljc1LDgsNjg1LjM1LDMuNjhBMzcuNzEsMzcuNzEsMCwwLDAsNjUxLjYyLDQuM1oiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0zMy4yOCw2MS4xMUMxNS45MSw2Mi4zNCw5LDY2LjQyLDMuNjUsNzguNDgtLjIzLDg3LjA2LS4yMyw5Ni40Ni4xOCw0NTNjLjYxLDM2NS43Ny42MSwzNjYsNC45LDM3MS43LDIuMjUsMy4wNyw4LjE3LDcuNzYsMTMuMDgsMTAuMjJsOSw0LjdIMjE1Ljc2YzEwMy44MSwwLDE4OC42MS0uNDEsMTg4LjYxLTFzLTQuMjktNi41NC05LjYtMTIuODdjLTUuNTItNi4zNC0xNC45Mi0xOS42Mi0yMS0yOS40M2wtMTEuMjQtMTcuNzktMTQwLS4yYy0xNTYuNTMsMC0xNTAuNC42MS0xNTgtMTQuMy0zLjI3LTYuNzQtMy40Ny0yMy4wOS0zLjA3LTI3NS4yNWwuNjEtMjY4LjFMNjYuMzgsMjE1YzIuMjUtMy4wNyw2LjU0LTYuOTUsOS4yLTguMTcsMy44OC0yLDc4Ljg4LTIuNjYsMzQzLjMtMi42Nkg3NTcuMjdsNS41Miw0LjI5YzkuNCw3LjM2LDEwLjQyLDExLjQ0LDExLjQ0LDQ0LjM0bDEsMzEuMjYsMTcsNi45NWM5LjQsMy44OCwyMi44OSwxMC4yMiwzMC4yNCwxNC4xbDEzLjI4LDcuMzYtLjYxLTExNWMtLjYxLTExMS4zNy0uODItMTE1LTQuNy0xMjItOC0xMy40OS0xNC4xLTE1LjMzLTUxLjA5LTE1LjMzLTE4LS4yLTM2LjE3LjIxLTQwLjY2LjgybC04LC44MiwxLjQzLDE2LjU1YzEuNjMsMjAuNDMtMS40Myw0NS03LjE1LDU4LjQ0LTguNzksMjAuMjMtMjkuNjMsMzMuMS01NCwzMy41MS0yNy41OS4yMS00NS4zNi0xMC01Ni42LTMzLjEtNi41NC0xMy4yOC02Ljc0LTE0LjMtNy41Ni00NC43NWwtLjYxLTMxLjI2LTktLjIxSDIzOS44OGwtMTEuMjQuMjFWODguNWMwLDM2LTQuMDksNTAuNDctMTguMzksNjQuNTctNy41Niw3Ljc2LTEyLjY3LDEwLjgzLTIzLjUsMTQuMS0xNi4xNCw1LjExLTIyLjY4LDUuMzEtMzcuNiwxLjQzLTIxLjI1LTUuNzItMzYuMTctMjAuNDMtNDIuNS00MS44OS0yLjQ1LTguMzgtMy4yNy0xOS0zLjA3LTM4LjYycy0uNDEtMjctMi4yNS0yNy4xOEM5MS41Miw2MC4wOCw0NS4xMyw2MC4yOSwzMy4yOCw2MS4xMVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik05Mi4xMywyMzEuOTRjLTQuNSwzLjA3LTQuNSwzLjY4LTQuNSw1MS45czAsNDguODQsNC41LDUxLjlDOTYsMzM4LjQsMTA0LjM5LDMzOSwxNDIuMTksMzM5YzQyLjkxLDAsNDUuNzctLjIsNDkuNjUtNC4wOXM0LjA5LTYuNzQsNC4wOS01MS4wOS0uMi00Ny4yLTQuMDktNTEuMDktNi43NC00LjA5LTQ5LjY1LTQuMDlDMTA0LjM5LDIyOC42Nyw5NiwyMjkuMjgsOTIuMTMsMjMxLjk0WiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTIyOS42NSwyMzMuNzdsLTUuMTEsNC45djkybDUuMzEsNC4wOWM1LjExLDQuMDksOCw0LjI5LDUwLjI3LDQuMjloNDQuNzVsNC45LTUuMTEsNS4xMS00LjlWMjM4LjY4bC01LjExLTQuOS00LjktNS4xMUgyMzQuNTVaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMzY4LDIzMS45NGMtNC41LDMuMDctNC41LDMuODgtNC41LDUxLjA5LDAsNDUuMTYuMiw0OCw0LjA5LDUxLjksMy42OCwzLjY4LDYuNzQsNC4wOSwzOS42NCw0LjA5aDM1LjU2bDE0LjUxLTEwLjgzLDE0LjUxLTEwLjYzVjI3Ny4xYzAtMzcuNi0uMi00MC40Ni00LjA5LTQ0LjM0cy02Ljc0LTQuMDktNDkuNjUtNC4wOUMzODAuMjUsMjI4LjY3LDM3MS44OCwyMjkuMjgsMzY4LDIzMS45NFoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik01MDUuNTEsMjMzLjc3Yy00LjksNC43LTUuMTEsNS43Mi01LjExLDM1Ljc2LDAsMTYuNzYuNDEsMzAuNjUuODIsMzAuNjVzOC41OC0zLjY4LDE4LTguMTdjMjIuMDctMTAuMjIsNTAuNjgtMTkuNjIsNzMuNTYtMjQuMTFsMTgtMy40N1YyNTEuNTVjMC0xMC44My0uODItMTMuNjktNS4xMS0xNy43OGwtNC45LTUuMTFINTEwLjQxWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTY0My40NSwyMzIuNzVjLTMuMDcsMy4wNy00LjA5LDYuNzQtNC4wOSwxNi4xNHYxMS44Nkw2NzIuNjcsMjYyYzIwLjIzLjgyLDQxLjA3LDIuODYsNTMuNTQsNS41MiwxMS4yNCwyLjI1LDIwLjY0LDQuMDksMjEsNC4wOS4yMSwwLC40MS04LjE3LjQxLTE4LjE5LDAtMjUuNzUsMi4yNS0yNC43My01NC41Ni0yNC43M0M2NTAuMTksMjI4LjY3LDY0Ny4zMywyMjguODcsNjQzLjQ1LDIzMi43NVoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik02MTEuNzcsMjkyLjgzYTMyOC42NywzMjguNjcsMCwwLDAtMTM2LjcxLDU1Ljc5Yy0yMS44NiwxNS43My01OC40Myw1Mi4zMS03NC4xNyw3NC43OC02Ny4yMyw5NS40My03Ny40NSwyMTcuODMtMjcuMTgsMzIzLjQ3LDM2LjM3LDc2LDEwNSwxMzYuNzEsMTg0LjczLDE2My4yNywzNy42LDEyLjQ2LDU4Ljg1LDE1Ljk0LDEwMS4zNSwxNi4xNCw0My4xMi4yLDY4LjI1LTMuODgsMTA1LTE2LjU1LDE2NC4wOS01Ni44MSwyNTIuNTctMjMzLjE1LDIwMC0zOTguMDZDOTQ4LjczLDQ2MS40MSw5MjQsNDIxLDg4NS44LDM4Mi45NGMtNDUtNDUtOTYuNDUtNzMuMTUtMTU5LTg3LjA1QzcwMi41LDI5MC4zOCw2MzYuOTEsMjg4Ljc0LDYxMS43NywyOTIuODNaTTcyMC4wOCwzOTYuNjRDNzMwLjcxLDQwNSw3MzEuMzIsNDA5LjEsNzMxLjMyLDQ3N3Y2Mi4zMkg4NjIuNTFsNyw3LDYuOTUsNi45NXY1NC4zNWMwLDQ3LjgyLS40MSw1NS4xNy0zLjQ3LDU5Ljg3LTYuNzQsMTAuMjItMTEuNjUsMTAuODMtNzkuMjksMTAuODNINzMxLjMzbC0uMiw2MS43MWMwLDY3LS44Miw3Mi43NS0xMC42Myw4MC4xLTUuNTIsNC4wOS04Ljc5LDQuMjktNTIuMTEsNC45LTU1Ljc4LjgyLTYxLjcxLjIxLTY5Ljg4LThsLTYuMTMtNi4zNFY2NzguMkg1MjguODNjLTU0LjU2LDAtNjQuNTctLjQxLTcwLjUtMy4yNy0xMi40Ny01LjkyLTEzLjA4LTguNzktMTMuMDgtNjguNDZWNTUzLjE0bDYuOTUtNi45NSw2Ljk1LTdINTkyLjM4VjQ3My4wNmMwLTY0LjM3LjIxLTY2LjIxLDQuMjktNzEuNTIsMi40NS0zLjA3LDYuMzQtNi41NCw4Ljc5LTcuMzYsMi4yNS0xLDI3Ljc5LTEuODQsNTYuNi0xLjg0QzcxMi43MiwzOTIuMTQsNzE0LjU2LDM5Mi4zNCw3MjAuMDgsMzk2LjY0WiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTkxLjExLDM3MS4zYy0zLjA2LDMuMjctMy40NywxMC0zLjQ3LDUxLjA5LDAsNDAuMDUuNDEsNDcuNjEsMy4yNyw1MC4yNywyLjY2LDIuODYsMTAuMjIsMy4yNyw1MC42OCwzLjI3LDQzLjUzLDAsNDcuODItLjQxLDUwLjg4LTMuNjhzMy40Ny0xMCwzLjQ3LTUwLjg4YzAtNDIuOTEtLjQxLTQ3LjItMy42OC01MC4yN3MtMTAtMy40Ny01MC44OC0zLjQ3Qzk4LjQ2LDM2Ny42Miw5NC4xNywzNjgsOTEuMTEsMzcxLjNaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMjI4LjYzLDM3MS43MWMtMy44OCwzLjg4LTQuMDksNi43NC00LjA5LDQ5LjY2LDAsMzcuOC42MSw0Ni4xOCwzLjI3LDUwLjA2LDMuMDYsNC41LDMuNjgsNC41LDUxLjksNC41aDQ5bDMuMDctNC45MWMyLjg2LTQuMjksMy4yNy0xMS44NSwyLjY2LTUxLjI5LS42MS00My4xMi0uODItNDYuNTktNC40OS00OS4yNS0zLjI3LTIuMjUtMTMuNjktMi44Ni01MC42OC0yLjg2QzIzNS4zNywzNjcuNjIsMjMyLjUxLDM2Ny44MiwyMjguNjMsMzcxLjcxWiIvPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTM2Ni43NywzNzEuNWMtMi44NiwzLjA2LTMuMjcsNy43Ni0yLjg2LDI5LjYzbC42MSwyNS45NSwxMC42My0xNS4zM2M1LjkzLTguMzgsMTYuMzUtMjEuNjYsMjMuMDktMjkuNjNsMTIuNDctMTQuNTFIMzkwLjQ4QzM3My4zMSwzNjcuNjIsMzY5LjgzLDM2OC4yMywzNjYuNzcsMzcxLjVaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNOTIuMTMsNTA3LjhjLTQuNSwzLjA2LTQuNSwzLjY4LTQuNSw1MS45czAsNDguODQsNC41LDUxLjljMy44OCwyLjY2LDEyLjI2LDMuMjcsNTAuMDYsMy4yNyw0Mi45MSwwLDQ1Ljc3LS4yMSw0OS42NS00LjA5czQuMDktNi43NCw0LjA5LTUwLjY4YzAtMjUuNTQtLjgyLTQ3LjQxLTEuNjMtNDguNjMtMy44OC01LjkyLTExLjI0LTctNTQtN0MxMDQuMTksNTA0LjUzLDk2LDUwNS4xNCw5Mi4xMyw1MDcuOFoiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0yMjkuNjUsNTA5LjY0bC01LjExLDQuOXY0NS43N2MwLDQzLjEyLjIsNDUuNzcsNC4wOSw1MC4wNiw0LjA5LDQuMjksNS43Miw0LjUsNDUsNC41aDQwLjg3VjU5OC45M2MwLTIxLDMuNDctNDcuNjEsOS4yLTcxLjUyLDMuNDctMTQuNzEsNC4wOS0yMC4yMywyLjQ1LTIxLjI1LTEuNDMtLjgyLTIyLjQ4LTEuNjMtNDctMS42M0gyMzQuNTZaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNOTEuMTEsNjQ3LjE2Yy0zLjA2LDMuMjctMy40NywxMC0zLjQ3LDUwLjY4LDAsMzcuMzkuNjEsNDcuODIsMi44Niw1MS4wOSwyLjg2LDMuNjgsNS43MiwzLjg4LDQ5Ljg2LDMuODgsNDMuMzIsMCw0Ny40MS0uMjEsNTEuMjktMy44OCw0LjA5LTMuNjgsNC4yOS01LjcyLDQuMjktNTEuNSwwLTQ2Ljc5LDAtNDcuNjEtNC41LTUwLjY4LTMuODgtMi42Ni0xMi4yNi0zLjI3LTUwLjg4LTMuMjdDOTguNDYsNjQzLjQ4LDk0LjE3LDY0My44OSw5MS4xMSw2NDcuMTZaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMjI4LjYzLDY0Ny41N2MtMy44OCwzLjg4LTQuMDksNi43NC00LjA5LDQ5Ljg2LDAsNDEuODkuNDEsNDYuMTgsMy44OCw1MC40NywzLjg4LDQuOTEsMy44OCw0LjkxLDUxLjI5LDQuOTFzNDcuNDEsMCw1MS4yOS00LjkxYzUuNTItNi43NCw0LjktMTcuMzctMi00MC44N2EzNzcuMDksMzc3LjA5LDAsMCwxLTkuNi00MS44OWwtMy42OC0yMS42NkgyNzQuMkMyMzUuMzcsNjQzLjQ4LDIzMi41MSw2NDMuNjksMjI4LjYzLDY0Ny41N1oiLz48L2c+PC9nPjwvc3ZnPg==";
    $position = 50;
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

    //Adicionar submenus
    //add_submenu_page("integracao-real-clinic", "Integração Real Clinic", "Procedimentos Padrões", $capability, "integracaoRC", array($this, "submenuProcedimentosPadroes"));
  }

  function criaMenu(){
    require_once($this->caminhoViews.'jsPHP'.DIRECTORY_SEPARATOR.'variaveis.php');
    $this->roteador = new RoteadorPluginModelo;
    $this->roteador->redireciona(array("CriaMenu", "menuConfiguracoes"));
  }

  function paginaModelo($atts = [], $content = null){
    require_once($this->caminhoViews.'jsPHP'.DIRECTORY_SEPARATOR.'variaveis.php');

    if (!is_admin()) {
      $this->roteador = new RoteadorPluginModelo;
      return $this->roteador->redireciona(array("PaginaModelo", "paginaModeloPlugin"));
    }
  }

  function redirect_custom($url){
    echo "<script>
    window.location = '".$url."';
    </script>";
  }

  function scriptsMenuAdmin(){
    wp_enqueue_style("meterializeRCCSS", $this->urlPlugin."public/css/materialize.css", array(), "1.0", false);

    wp_enqueue_script("jqueryRCJS", $this->urlPlugin."public/js/jquery.js", array(), "1.0", true);
    wp_enqueue_script("materializeRCJS", $this->urlPlugin."public/js/materialize.js", array(), "1.0", true);
  }

  function redirecionaTela($url="document.location.href"){
    echo "<script type='text/javascript'>window.location = ".$url." </script>";
  }

  function declaraAutoload(){
    $this->roteador = new RoteadorPluginModelo;
    $this->roteador->declaraAutoload();
  }

  function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
  }
}

if(class_exists("PluginModelo")){
  $pluginModelo = new PluginModelo;
}

if(class_exists("IndoorTechAtualizacao")){
  $indoorTechAtualizacao = new IndoorTechAtualizacao(__FILE__);
}

register_activation_hook(__FILE__, array($pluginModelo,'ativar'));

//Ações do plugin
add_action("admin_head", function(){
    echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
});
add_action("admin_menu", array($pluginModelo, "declararMenu"));
add_action("admin_enqueue_scripts", array($pluginModelo, "scriptsMenuAdmin"));

//verifica se ha atualizao e extendida do IndooTechAtualizacao
add_filter('site_transient_update_plugins', array($indoorTechAtualizacao,'verificaAtualizacao'));

//Shortcodes de páginas
add_shortcode("paginaModeloIndoor", array($pluginModelo, "paginaModelo"));
