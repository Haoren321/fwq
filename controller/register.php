<?php
require "../ben/dbConnect.php";
require "../ben/user.php";
  $userInfo = $_POST['userInfo'];
  $coverImg = $_FILES['userIcon'];
  if($userInfo != NULL){
      dbInit();
      $setUser = new user;
      $user = json_decode($userInfo,true);
      $userInconName = $coverImg['name'];
      $userName= $user['userName'];
      $userPwd = $user['userPwd'];
      $userPhone = $user['userPhone'];
      $dir = "../img/userIcon/admin.jpg";
      if($coverImg != NULL){
          $dir = "../img/userIcon/".$userPhone;
          if(!file_exists($dir)){
            mkdir($dir,0777,true);
          }
          move_uploaded_file($coverImg['tmp_name'],"$dir/$userInconName");
          $dir = "/img/userIcon/".$userPhone;
      }
      $sql = "INSERT INTO `user` (`userId`, `userName`, `userIcon`, `password`, `userPhone`) VALUES (NULL, '$userName', '$dir/$userInconName', '$userPwd', '$userPhone')";
      $result = query($sql);
      if($result != 1){
        die;
      }
      $sql = "SELECT * FROM `user` WHERE userPhone = $userPhone";
      $result = query($sql);
      if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $user = $row;
        echo json_encode($user);
      }      
  }
?>