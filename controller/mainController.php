<?php
// dependencies
require_once "../model/rubriquesModel.php";

$recupRubriques = selectAllRubriques($db);

//$menu = createMenu(0,0,$recupRubriques);
$menuCSS = createMenuCSS(0,0,$recupRubriques);
$menuBootstrap = createMenuBootstrap(0,0,$recupRubriques);

require_once "../view/indexView.php";