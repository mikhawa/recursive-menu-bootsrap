<?php
function mkmap($dir){
    $out = "<ul>";
    $folder = opendir ($dir);

    while ($file = readdir ($folder)) {
        if ($file != "." && $file != "..") {
            $pathfile = $dir.'/'.$file;
            $out.= "<li><a href=$pathfile>$file</a></li>";
            if(filetype($pathfile) == 'dir'){
                $out .=mkmap($pathfile);
            }
        }
    }
    closedir ($folder);
    $out.= "</ul>";
    return $out;
}
?>

<?php echo mkmap('.'); ?>