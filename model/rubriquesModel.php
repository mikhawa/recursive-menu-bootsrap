<?php
// Select all rubriques
function selectAllRubriques($c){
    $sql = "SELECT * FROM rubriques;";
    $req = mysqli_query($c,$sql) or die(mysqli_error($c));
    return (mysqli_num_rows($req))? mysqli_fetch_all($req,MYSQLI_ASSOC):[];
}

function createMenu(int $parent, int $level, array $rubriques){
    $out ="";
    $prevLevel=0;

    if(!$level && !$prevLevel) $out.="<ul>";

    foreach($rubriques as $node){
        if($parent==$node['rubriques_idrubriques']){
            if($prevLevel<$level) $out.="<ul>";
            $out .="<li>".$node['rubriques_name'];
            $prevLevel=$level;
            $out .= createMenu($node['idrubriques'],($level+1),$rubriques);
        }
    }
    if(($prevLevel==$level) && ($prevLevel !=0)) $out .= "</li></ul>";
    elseif($prevLevel==$level) $out .= "</ul>";
    else $out .="";

    return $out;
}