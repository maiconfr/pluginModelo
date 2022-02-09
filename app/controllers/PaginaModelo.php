<?php

/**
 *
 */
class PaginaModelo extends Pagina
{

  function __construct()
  {
    parent::__construct();
  }

  function paginaModeloPlugin(){
    wp_enqueue_style("meterializePluginCSS", $this->urlPlugin."public/css/materialize.min.css", array(), "1.0", false);

    wp_enqueue_script("jqueryPluginJS", $this->urlPlugin."public/js/jquery.js", array(), "1.0", true);
    wp_enqueue_script("materializePluginJS", $this->urlPlugin."public/js/materialize.min.js", array(), "1.0", true);
    wp_enqueue_script("initPluginJS", $this->urlPlugin."public/js/init.js", array(), $this->versaoScript, true);

    ob_start();
    require_once($this->caminhoViews.DIRECTORY_SEPARATOR.'paginaModelo.php');
    return ob_get_clean();
  }
}
