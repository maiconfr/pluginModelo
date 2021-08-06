<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "app/libs/config.php";


//$agendamentosDbM->insertRelatoriosDeOntemEmDiante();
$PageController->header();
bodyDaPagina();
$PageController->footer();



//$PageController->viewJsonUltimos60DiasAgendamentosPorDataDeCriacao();
