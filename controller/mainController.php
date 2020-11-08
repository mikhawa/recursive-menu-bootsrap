<?php
// dependencies
require_once "../model/rubriquesModel.php";

$recupRubriques = selectAllRubriques($db);

var_dump($recupRubriques);