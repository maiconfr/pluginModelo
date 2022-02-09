<?php
/**
 *
 */


class IndoorTechAtualizacao
{
  public $tempoDeCacheTransient = 20;

  public $nomeDoPacote = "";
  public $urlJsonUpdate = "";
  public $versaoPlugin = "";
  public $caminhoBasePlugin = "";

  function __construct($nomeFile)
  {
    include_once dirname($nomeFile).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."wp-admin".DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."plugin.php";
    $dataPlugin = get_plugin_data($nomeFile);
    //echo "<pre>";print_r($dataPlugin);echo "</pre>";
    $this->urlJsonUpdate = $dataPlugin["UpdateURI"].$dataPlugin["TextDomain"].".json";

    $this->nomeDoPacote = $dataPlugin["TextDomain"];
    $this->versaoPlugin = $dataPlugin["Version"];
    $this->caminhoBasePlugin = $nomeFile;
  }

  protected function aoAtualizar(){
    global $wpdb;
    $wpdb_collate = $wpdb->collate;
  }

  function triggerUpdate( $upgrader_object, $options ) {
      $nomeBaseDoPacote = plugin_basename($this->caminhoBasePlugin);
      if ($options['action'] == 'update' && $options['type'] == 'plugin' ) {
         foreach($options['plugins'] as $each_plugin) {
            if ($each_plugin==$nomeBaseDoPacote) {
               $this->aoAtualizar;
            }
         }
      }
  }

  function verificaAtualizacao( $transient ){

    if ( empty($transient->checked ) ) {
      return $transient;
    }

    if( false == $remote = get_transient( $this->nomeDoPacote.'_transient_upgrade' ) ) {

      // info.json is the file with the actual plugin information on your server
      $remote = wp_remote_get( $this->urlJsonUpdate, array(
        'timeout' => 10,
        'headers' => array(
          'Accept' => 'application/json'
        ) )
      );

      //echo "<pre>";print_r($remote);echo "</pre>";

      if ( !is_wp_error( $remote ) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty( $remote['body'] ) ) {
        set_transient(  $this->nomeDoPacote.'_transient_upgrade', $remote, $this->tempoDeCacheTransient );
      }

    }

    if( $remote ) {

      $remote = json_decode( $remote['body'] );

      if( $remote && version_compare( $this->versaoPlugin, $remote->version, '<' ) ) {

        $res = new stdClass();
        $res->slug = $this->nomeDoPacote;
        $res->plugin = plugin_basename($this->caminhoBasePlugin); // it could be just YOUR_PLUGIN_SLUG.php if your plugin doesn't have its own directory
        $res->new_version = $remote->version;
        $res->package = $remote->download_url;
        $transient->response[$res->plugin] = $res;
      }

    }
    return $transient;
  }

}
