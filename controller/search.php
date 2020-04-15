<?php
    require "../ben/dbConnect.php";
    $code = $_GET['all'];
    dbInit();
    $sql = "SELECT * FROM `sv_video` WHERE sv_video.title LIKE '%$code%'";
    $result = query($sql);
    $Array = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($Array, $row);
        }
        echo  json_encode($Array);
    }
?>