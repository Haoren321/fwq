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
    }else if($postCode == "initTmp_video"){
        initTmp_video();
    }else if($postCode = "updata"){
        $videoInfo = $_POST['videoInfo'];
        passVideo($videoInfo);
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
        for($i=0; $i<count($tagArray)-1;$i++){
            $tag = $tagArray[$i];
            if($tag == "游戏"){
                $tagId = "1001";
            }else if($tag = "音乐"){
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
?>