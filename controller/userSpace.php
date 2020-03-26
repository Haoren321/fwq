<?php
    require "../ben/dbConnect.php";
    $code = $_POST['code'];
    if($code == "fansGet"){
        $userId = $_POST['userId'];
        fansGet($userId);
    }else if($code == "upInfo"){
        $upIcon = $file = $_FILES['icon'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $userId = $_POST['userId'];
        dbInit();
        if($upIcon != ""){
            $fileName = $file['name'];
            $dir = $_POST['userPhone'];
            $path = '/img/userIcon/'.$dir;
            $finish = move_uploaded_file($file['tmp_name'],"../$path/$fileName"); 
            $sql = "UPDATE `user` SET `userName` = '$userName',`password`='$password',`userIcon` = '$path/$fileName' WHERE `user`.`userId` = $userId";         
        }else{
            $sql = "UPDATE `user` SET `userName` = '$userName',`password`='$password' WHERE `user`.`userId` = $userId";
        }         
        query($sql); 
        $sql = "SELECT * FROM `user` WHERE userId = 2027";
        $result = query($sql);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            $user = $row;
            echo json_encode($user);
          } 
    }
    function fansGet($userId){
        dbInit();
        $sql = "SELECT * FROM `foucs` WHERE beFoucsId = $userId";
        $result = query($sql);
        $fans = array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                array_push($fans,$row);
            }
        }
        $sql = "SELECT * FROM `foucs`WHERE foucsUserId = $userId";
        $result = query($sql);
        $care = array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                array_push($care,$row);
            }
        }
        $arr = array('fans'=>$fans,'care'=>$care);
        echo json_encode($arr);
    }
