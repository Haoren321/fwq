<?php
    require "../ben/dbConnect.php";
    $postCode = $_POST['code'];
    if($postCode == NULL){
        die;
    }
    if($postCode == "login"){
        if($_POST['admin']){
            $admin = $_POST['admin'];
            $_admin = json_decode($admin,true);
            loginAdminSystem($_admin);
        }else{
            echo "账号不能为空";
        }
    }elseif($postCode == "initTmp_video"){
        initTmp_video();
    }elseif($postCode == "updata"){
        $videoInfo = $_POST['videoInfo'];
        passVideo($videoInfo);
    }elseif($postCode == "delet"){
        $tmp_svid = $_POST['tmp_svid'];
        $tmp_file = $_POST['tmp_file'];
        buTongGuo($tmp_svid,$tmp_file);
    }elseif($postCode == 'getReport'){
        getReport();
    }elseif($postCode == 'violation'){
        $reportSvid = $_POST['reportSvid'];
        $path = $_POST['reportPath'];
        violation($reportSvid,$path);
    }elseif($postCode == "reportDelet"){
        $reportSvid = $_POST['reportSvid'];
        reportDelet($reportSvid);
    }elseif($postCode == "videoSystemMange"){
        videoSystemMange();
    }elseif($postCode == "systemDeletVideo"){
        $reportSvid = $_POST['reportSvid'];
        $path = $_POST['reportPath'];
        systemDeletVideo($reportSvid,$path);
    }elseif($postCode == 'saveAlterVideo'){
        $title = $_POST['title'];
        $introduction = $_POST['introduction'];
        $tag = $_POST['tag'];
        $svid = $_POST['svid'];
        saveAlterVideo($title,$introduction,$tag,$svid);
    }elseif($postCode == "getUser"){
        getUser();
    }elseif($postCode == "adminAlterUser"){
        $userId = $_POST['id'];
        $userName = $_POST['name'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        adminAlterUser($userId,$userName,$password,$phone);
    }
    
    function passVideo($videoInfo){
        $video = json_decode($videoInfo,true);
        $dir = $video['videoFile'];
        $svid = $video['sv_id'];
        $title = $video['title'];
        $author = $video['userId'];
        $oldPath = "../video/tmp_video/".$dir;
        $newPath = "../video/video/".$author;
        if(file_exists($oldPath)){
            if(!file_exists($newPath)){
                mkdir($newPath,0777,true);   
            }
            fopen($oldPath."/dm.json","w");
            fopen($oldPath."/comment.json","w");
            rename($oldPath,$newPath."/".$dir);
            //fopen($newPath."/info.json","w");
        }
        $savePath = "/video/video/".$author;
        $coverimg = $savePath."/".$dir."/".$video['coverImgName'];
        $videoUrl = $savePath."/".$dir."/".$video['videoName'];
        $introduction = $video['introduction'];
        $tags = $video['tag'];
        $sql = "INSERT INTO `sv_video` (`sv_id`, `title`, `cover_img`, `source_url`, `author`, `introduction`, `cout_watch`, `tags`) VALUES ($svid, '$title','$coverimg', '$videoUrl', '$author',' $introduction', 0,'$tags')";
        query($sql);
        $tagArray = explode(" ",$tags);
        for($i=0; $i<count($tagArray);$i++){
            $tag = $tagArray[$i];
            if($tag == "游戏"){
                $tagId = "1001";
            }else if($tag == "音乐"){
                $tagId = "1002";
            }else if($tag == "动画"){
                $tagId = "1003";
            }else{
                $tagId = "1004";
            }
            $sql = "INSERT INTO `zjb` (`id`, `tagId`, `svId`) VALUES (NULL, $tagId, $svid)";
            query($sql);
        }
        $sql = "DELETE FROM `tmp_video` WHERE `tmp_video`.`sv_id` = $svid";
        $result = query($sql);
        echo $result;
    }
    function buTongGuo($tmp_svid,$tmp_file){
        require "delFunction.php";
        $path = "../video/tmp_video/".$tmp_file;
        delDir($path);
        $sql = "DELETE FROM tmp_video WHERE tmp_video.sv_id = '$tmp_svid'";
        $result = query($sql);
        echo $result;      
    }
    function initTmp_video(){
        dbInit();
        $sql = "SELECT * FROM `tmp_video`";
        $result = query($sql);
        if($result->num_rows>0){
            $resultArray = array();
            while($row = $result->fetch_assoc()){
                array_push($resultArray,$row);
            }
            echo json_encode($resultArray);
        }
    }
    function loginAdminSystem ($_admin){
        dbInit();
        $pw = $_admin['pw'];
        $adminId = $_admin['adminId'];
        $sql = "SELECT * FROM `admin` WHERE adminId = $adminId";
        $result = query($sql);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $dbpw = $row['pw'];
            if($pw == $dbpw){
                $setAdmin = array('adminId'=>$row['adminId'],'isLogin'=>true);
                echo json_encode($setAdmin);
            }else{
                echo "密码不正确";
            }
        }
    }
    function getReport(){
        dbInit();
        //$sql = "DELETE reportvideo,sv_video,zjb FROM reportvideo LEFT JOIN sv_video ON reportvideo.sv_id = sv_video.sv_id LEFT JOIN zjb ON reportvideo.sv_id = zjb.svId WHERE reportvideo.sv_id = \'10017\'";
        $sql = "SELECT * FROM `reportvideo` LEFT JOIN sv_video ON reportvideo.sv_id = sv_video.sv_id";
        $result = query($sql);
        if($result->num_rows>0){
            $resultArray = array();
            while($row = $result->fetch_assoc()){
                array_push($resultArray,$row);
            }
            echo json_encode($resultArray);
        }
    }
    function violation($reportSvid,$path){
        require "delFunction.php";
        $itemPath = "..".$path;
        delDir($itemPath);   
        dbInit();
        $sql = "DELETE reportvideo,sv_video,zjb FROM reportvideo LEFT JOIN sv_video ON reportvideo.sv_id = sv_video.sv_id LEFT JOIN zjb ON reportvideo.sv_id = zjb.svId WHERE reportvideo.sv_id = '$reportSvid'";       
        $result = query($sql);
        echo $result;
    }
    function reportDelet($reportSvid){
        dbInit();
        $sql = "DELETE FROM reportvideo WHERE reportvideo.sv_id = '$reportSvid'";
        $result = query($sql);
        echo $result;           
    }
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
    function systemDeletVideo($reportSvid,$path){
        require "delFunction.php";
        $itemPath = "..".$path;
        delDir($itemPath);   
        dbInit();
        $sql = "DELETE reportvideo,sv_video,zjb FROM sv_video LEFT JOIN reportvideo ON reportvideo.sv_id = sv_video.sv_id LEFT JOIN zjb ON sv_video.sv_id = zjb.svId WHERE sv_video.sv_id = '$reportSvid'";       
        $result = query($sql);
        echo $result;        
    }
    function saveAlterVideo($title,$introduction,$tag,$svid){
        dbInit();
        $sql = "UPDATE `sv_video` SET `title` = '$title',`introduction` = '$introduction',`tags`='$tag' WHERE `sv_video`.`sv_id` = '$svid'";
        $result = query($sql);
        echo $result;
    }
    function getUser(){
        dbInit();
        $sql = "SELECT * FROM `user`";
        $result = query($sql);
        if($result->num_rows>0){
            $resultArray = array();
            while($row = $result->fetch_assoc()){
                array_push($resultArray,$row);
            }
            echo json_encode($resultArray);
        }
    }
    function adminAlterUser($userId,$userName,$password,$phone){
        dbInit();
        $sql = "UPDATE `user` SET `userPhone` = '$phone',`userName` = '$userName',`password`='$password' WHERE `user`.`userId` = '$userId'";
        $result = query($sql);
        echo $result;
    }
?>