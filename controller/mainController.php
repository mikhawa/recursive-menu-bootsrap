<?php
// dependencies
require_once "../model/rubriquesModel.php";

$recupRubriques = selectAllRubriques($db);

$menu = createMenuCSS(0,0,$recupRubriques);

require_once "../view/indexView.php";