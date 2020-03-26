<?php
    require "../ben/dbConnect.php";
    $code = $_POST['code'];
    if($code == "getInfo"){
        $userId = $_POST['userId'];
        getInfo($userId);
    }

    function getInfo($userId){
        dbInit();
        $sql = "SELECT * FROM `user`,`sv_video`WHERE userId = sv_video.author AND user.userId= $userId";
        $result = query($sql);
        $videoArray = array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                array_push($videoArray,$row);
            }
            echo  json_encode($videoArray) ;
        }
    }
?>