<?php
    require "../ben/dbConnect.php";
    $_userId = $_POST['userId'];
    if($_userId != NULL){
        dbInit();
        $sql = "SELECT * FROM `tmp_video` WHERE userId = $_userId";
        $result = query($sql);
        $auditVideoArray = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                array_push($auditVideoArray,$row);
                //var_dump($row);
            }
        }
        $sql = "SELECT * FROM `sv_video` WHERE author = $_userId";
        $result = query($sql);
        $videoArray = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                array_push($videoArray,$row);
            }
        }
        $arr=array('video'=>$videoArray,'auditVideo'=>$auditVideoArray);
        echo json_encode($arr);
    }
    //var_dump($_userId);
?>