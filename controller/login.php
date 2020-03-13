<?php
require "../ben/dbConnect.php";
require "../ben/user.php";
  $userInfo = file_get_contents("php://input");
  if($userInfo != NULL){
      dbInit();
      $setUser = new user;
      $user = json_decode($userInfo,true);
      $userId= $user['userId'];
      $userPwd = $user['userPwd'];

      $sql = "SELECT * FROM `user` WHERE userId=$userId";
      $result = query($sql);
      if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        if($row['password'] == $userPwd){
            $user = $row;
            echo json_encode($user);
        }else{
            echo "密码不存在";
        }
      }else{
          echo "账号不存在";
      }
  }
?>