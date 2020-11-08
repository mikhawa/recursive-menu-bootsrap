<?php
// Select all rubriques
function selectAllRubriques($c){
    $sql = "SELECT * FROM rubriques ORDER BY rubriques_order ASC;";
    $req = mysqli_query($c,$sql) or die(mysqli_error($c));
    return (mysqli_num_rows($req))? mysqli_fetch_all($req,MYSQLI_ASSOC):[];
}

function createMenu(int $parent, int $level, array $rubriques){
    $out ="";
    $prevLevel=0;

    if(!$level && !$prevLevel) $out.="\n<ul>\n";

    foreach($rubriques as $node){
        if($parent==$node['rubriques_idrubriques']){
            if($prevLevel<$level) $out.="\n<ul>\n";
            $out .="    <li><a href='?id={$node['idrubriques']}'>".$node['rubriques_name']."</a></li>";
            $prevLevel=$level;
            $out .= createMenu($node['idrubriques'],($level+1),$rubriques);

        }

    }
    if(($prevLevel==$level) && ($prevLevel !=0)) $out .= "</ul>\n";
    elseif($prevLevel==$level) $out .= "</ul>\n";
    else $out .="\n";

    return $out;
}
