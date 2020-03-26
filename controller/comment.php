<?php
    $code = $_POST['code'];
    if($code == "getComment"){
        $filePath = $_POST['filePath'];
        $json_string = file_get_contents("../video/video/".$filePath."/comment.json");        
        echo $json_string ;        
    }
    if($code == "saveComment"){
        $filePath = $_POST["filePath"];
        $file = fopen("../video/video/".$filePath."/comment.json","w");
        $commnetJson = $_POST['commentJson'];
        fwrite($file,$commnetJson);
        fclose($file);
    }
?>