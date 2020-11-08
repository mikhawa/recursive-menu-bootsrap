<?php
// Select all rubriques
function selectAllRubriques($c){
    $sql = "SELECT * FROM rubriques;";
    $req = mysqli_query($c,$sql) or die(mysqli_error($c));
    return (mysqli_num_rows($req))? mysqli_fetch_all($req,MYSQLI_ASSOC):[];
}