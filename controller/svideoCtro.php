<?php
    require "../ben/dbConnect.php";
    $code = $_POST['code'];
    if($code == "recommand"){
        getHomePage();
    }else if($code == "initVideo"){
        $sv_id = $_POST['sv_id'];
        initVideo($sv_id);
    }else if($code == "foucs"){
        $foucsId = $_POST['foucs'];
        $beFoucsId = $_POST['beFoucs'];
        getFocus($foucsId,$beFoucsId);
    }else if($code == "delFoucs"){
        $foucsId = $_POST['foucs'];
        $beFoucsId = $_POST['beFoucs'];
        delFoucs($foucsId,$beFoucsId);       
    }else if($code == "upFoucs"){
        $foucsId = $_POST['foucs'];
        $beFoucsId = $_POST['beFoucs'];
        $beFoucsName = $_POST['beFoucsName'];
        upFoucs($foucsId,$beFoucsId,$beFoucsName);  
    }

    function getHomePage(){
        dbInit();
        $sql = $sql = "SELECT * FROM `sv_video` limit 4";
        $result = query($sql);
        $videoArray = array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                array_push($videoArray,$row);
            }
            echo  json_encode($videoArray) ;           
        }
    }
    function initVideo($sv_id){
        dbInit();
        $sql = "SELECT * FROM `sv_video`,`user`WHERE author = user.userId AND sv_video.sv_id = '$sv_id'";
        $result = query($sql);
        $videoArray = array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                array_push($videoArray,$row);
            }
            echo  json_encode($videoArray) ;
        }
    }
    function getFocus($foucsId,$beFoucsId){
        dbInit();
        $sql = "SELECT * FROM `foucs` WHERE foucsUserId = '$foucsId' AND beFoucsId = '$beFoucsId'";
        $result = query($sql);
        $Array = array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                array_push($Array,$row);
            }
            echo  json_encode($Array) ;
        }else{
            echo 0;
        }
    }
    function delFoucs($foucsId,$beFoucsId){
        $sql = "DELETE FROM `foucs` WHERE `foucs`.`foucsUserId` = '$foucsId' AND `foucs`.`beFoucsId` = '$beFoucsId'";
        $result = query($sql);
        //$Array = array();
        if($result){
            echo true;
        }else{
            echo false;
        }
    }
    function upFoucs($foucsId,$beFoucsId,$beFoucsName){
        $sql = "INSERT INTO `foucs` (`foucsId`, `foucsUserId`, `beFoucsId`, `beFoucsName`) VALUES (NULL, '$foucsId', '$beFoucsId', '$beFoucsName')";
        $result = query($sql);
        //$Array = array();
        if($result){
            echo true;
        }else{
            echo false;
        }      
    }
?>