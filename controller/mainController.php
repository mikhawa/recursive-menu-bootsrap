<?php
// dependencies
require_once "../model/rubriquesModel.php";

$recupRubriques = selectAllRubriques($db);

echo createMenu(0,0,$recupRubriques);