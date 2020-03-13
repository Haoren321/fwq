<?php
    require "../ben/dbConnect.php";
    $_userId = $_POST['userId'];
    if($_userId != NULL){
        dbInit();
        $sql = "SELECT * FROM `tmp_video` WHERE userId = $_userId";
        $result = query($sql);
        $videoArray = array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                array_push($videoArray,$row);
                //var_dump($row);
            }
        }
        echo json_encode($videoArray);
    }
    //var_dump($_userId);
?>