<?php
    $code = $_POST['code'];
    if($code == "getDm"){
        $filePath = $_POST['filePath'];
        $json_string = file_get_contents("../video/video/".$filePath."/dm.json");     
        echo $json_string ;        
    }
    if($code == "saveDm"){
        $filePath = $_POST["filePath"];
        $file = fopen("../video/video/".$filePath."/dm.json","w");
        $dmJson = $_POST['dm'];
        fwrite($file,$dmJson);
        fclose($file);
    }
?>