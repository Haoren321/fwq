<?php
    require "../ben/dbConnect.php";
    $videoInfo =  file_get_contents("php://input");
    if($videoInfo == NULL){
        die;
    }
    $videoAray = json_decode($videoInfo,true);
    $userId = $videoAray['userId'];
    $introduction = $videoAray['introduction'];
    $title = $videoAray['title'];
    $tagArry = $videoAray['tag'];
    $videoName = $videoAray['videoName'];
    $videoFile = $videoAray['videoFile'];
    $coverImgName = $videoAray['coverImgName'];
    $tagNum = count($tagArry);
    $tag = "";
    for($i=0;$i<$tagNum;$i++){
        $tag = $tag.$tagArry[$i].' ';
    }
    $sql = "INSERT INTO `tmp_video` (`userId`, `introduction`, `title`, `tag`, `videoName`, `videoFile`, `coverImgName`,`time`) VALUES ('$userId', '$introduction', '$title', '$tag', '$videoName', '$videoFile', '$coverImgName', NOW())";
    $result = query($sql);    
    echo $result;
?>