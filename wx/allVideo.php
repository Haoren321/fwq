<?php
require "../ben/dbConnect.php";
videoSystemMange();
function videoSystemMange(){
    dbInit();
    $sql = "SELECT * FROM `sv_video`";
    $result = query($sql);
    if($result->num_rows>0){
        $resultArray = array();
        while($row = $result->fetch_assoc()){
            array_push($resultArray,$row);
        }
        echo json_encode($resultArray);
    }
}
