<?php
    require "../ben/dbConnect.php";
    $code = $_POST['code'];
    if($code == 'lazyLoading'){
        $tag = $_POST['tag'];
        lazyLoad($tag);
    }
    function lazyLoad($tag){
        $sql = "SELECT sv_video.sv_id,sv_video.title,sv_video.cover_img,sv_video.introduction,sv_video.cout_watch,user.userName FROM zjb LEFT JOIN tags ON tags.tagId = zjb.tagId LEFT JOIN sv_video ON  zjb.svId = sv_video.sv_id  LEFT JOIN user ON user.userId = sv_video.author WHERE tags.tagName = '$tag'" ;
        $result = query($sql);
        $videoArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($videoArray, $row);
            }
            echo  json_encode($videoArray);
        }
    }
?>