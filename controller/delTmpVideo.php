<?php
    require "delFunction.php";
    $pathName = file_get_contents("php://input");
    $dirName = json_decode($pathName,true);
    $path = "../video/tmp_video/".$dirName['dirName'];
    delDir($path);
    //var_dump($fileName)
?>