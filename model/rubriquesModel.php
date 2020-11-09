<?php
// Select all rubriques
function selectAllRubriques($c)
{
    $sql = "SELECT * FROM rubriques;";
    $req = mysqli_query($c, $sql) or die(mysqli_error($c));
    return (mysqli_num_rows($req)) ? mysqli_fetch_all($req, MYSQLI_ASSOC) : [];
}

function createMenu(int $parent, int $level, array $rubriques)
{
    $out = "";
    $prevLevel = 0;

    if (!$level && !$prevLevel) $out .= "\n<ul>\n";

    foreach ($rubriques as $node) {
        if ($parent == $node['rubriques_idrubriques']) {
            if ($prevLevel < $level) $out .= "\n<ul>\n";
            $out .= "    <li><a href='?id={$node['idrubriques']}'>" . $node['rubriques_name'] . "</a></li>";
            $prevLevel = $level;
            $out .= createMenu($node['idrubriques'], ($level + 1), $rubriques);
        }
    }

    if (($prevLevel == $level) && ($prevLevel != 0)) $out .= "</ul>\n\n";
    elseif ($prevLevel == $level) $out .= "\n</ul>\n";
    else $out .= "\n";

    return $out;
}

function createMenuCSS(int $parent, int $level, array $rubriques)
{
    // initialisation à chaque récursivité
    $out = "";
    $prevLevel = 0;

    // premier passage
    if (!$level && !$prevLevel) $out .= "\n<ul>\n";

    // listage de chaques rubriques
    foreach ($rubriques as $node) {
        // si on est enfant d'une autre rubrique (ou au moins de l'accueil: 0)
        if ($parent == $node['rubriques_idrubriques']) {
            // et qu'on est le premier enfant on ajoute un ul
            if ($prevLevel < $level) $out .= "\n<ul>\n";
            // quelque soit le niveau on ajoute le li et le lien vers la rubrique + nom
            $out .= "    <li><a href='?id={$node['idrubriques']}'>" . $node['rubriques_name'] . "</a>";
            // si on n'est pas sur un parent, on ajoute le </li>
            if ($level != $parent) $out .= "</li>";
            // on met le level précédant à jour
            $prevLevel = $level;
            // on va chercher les sous-menus de la rubrique actuelle (! $out devient une sorte de 'globale', et ne sera donc pas effacée par l'initialisation : $out se remplit avec l'$out de l'initialisation et n'est donc pas vidée!), c'est notre récursivité de la fonction
            $out .= createMenuCSS($node['idrubriques'], ($level + 1), $rubriques);
        }
    }
    // si il n'y a plus de rubriques enfant de l'actuelle, on ferme le ul et li du parent
    if (($prevLevel == $level) && ($prevLevel != 0)) $out .= "\n</ul>\n</li>\n\n";
    // sinon si on est sur la dernière rubrique
    elseif ($prevLevel == $level) $out .= "</li>\n  </ul>\n";

    // envoie du contenu
    return $out;
}

function createMenuBootstrap(int $parent, int $level, array $rubriques)
{
    // initialisation à chaque récursivité
    $out = "";
    $prevLevel = 0;

    // premier passage
    if (!$level && !$prevLevel) $out .= "\n<ul>\n";

    // listage de chaques rubriques
    foreach ($rubriques as $node) {
        // si on est enfant d'une autre rubrique (ou au moins de l'accueil: 0)
        if ($parent == $node['rubriques_idrubriques']) {
            // et qu'on est le premier enfant on ajoute un ul
            if ($prevLevel < $level) $out .= "\n<ul>\n";
            // quelque soit le niveau on ajoute le li et le lien vers la rubrique + nom
            $out .= "    <li><a href='?id={$node['idrubriques']}'>" . $node['rubriques_name'] . "</a>";
            // si on n'est pas sur un parent, on ajoute le </li>
            if ($level != $parent) $out .= "</li>";
            // on met le level précédant à jour
            $prevLevel = $level;
            // on va chercher les sous-menus de la rubrique actuelle (! $out devient une sorte de 'globale', et ne sera donc pas effacée par l'initialisation : $out se remplit avec l'$out de l'initialisation et n'est donc pas vidée!), c'est notre récursivité de la fonction
            $out .= createMenuBootstrap($node['idrubriques'], ($level + 1), $rubriques);
        }
    }
    // si il n'y a plus de rubriques enfant de l'actuelle, on ferme le ul et li du parent
    if (($prevLevel == $level) && ($prevLevel != 0)) $out .= "\n</ul>\n</li>\n\n";
    // sinon si on est sur la dernière rubrique
    elseif ($prevLevel == $level) $out .= "</li>\n  </ul>\n";

    // envoie du contenu
    return $out;
}