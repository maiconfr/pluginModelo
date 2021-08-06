<?php
//debug mesages
$debug = true;
function debug($mensagem){
  global $debug;

  if ($debug){
    if (is_array($mensagem)){
      echo "<pre>";
      print_r($mensagem);
      echo "</pre>";
    }else
    echo $mensagem."<br>";
  }
}

$arrayJsFooter = array();
function addJSFooter($val){
  global $arrayJsFooter;
  array_push($arrayJsFooter, $val);
}

function geraDependenciasFooter(){
  global $arrayJsFooter;
  foreach ($arrayJsFooter as $key => $value) {
    if(strpos($value, ".js")>0){
      echo "<script type='text/javascript' src='".URLBASE."public/js/".$value."'></script>";
    }else{
      echo "<script type='text/javascript' src='".URLBASE."public/js/".$value.".js'></script>";
    }

  }
}

function addJSFooterPasta($pasta){
  $arrayFiles = scandir(DIRBASE.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR.$pasta);
  foreach ($arrayFiles as $key => $value) {
    if(strpos($value, ".js")>0){
      addJSFooter($pasta."/".$value);
    }

  }
}

// Organiza datas disponiveis dos médicos no agendamento
function organiza_data($element1, $element2) {
    $datetime1 = strtotime($element1['dia']);
    $datetime2 = strtotime($element2['dia']);
    return $datetime1 - $datetime2;
}

function redirecionaJs($urlDestino){
  echo "<script>window.location.href = '".$urlDestino."'</script>";
}
