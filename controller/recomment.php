<?php
require "../ben/dbConnect.php";
$_code = $_POST['code'];
if ($_code == "getList") {
    $tags = $_POST['tags'];
    $tagsArray = explode(" ", $tags);
    getList($tagsArray);
}
function getList($tagsArray)
{
    dbInit();
    $length = count($tagsArray) - 1;
    $stringTags = '';
    for ($i = 0; $i < $length; $i++) {
        $tag = $tagsArray[$i];
        if ($i == $length - 1) {
            $stringTags .= "tags.tagName = '$tag' ";
        }else{
            $stringTags .= "tags.tagName = '$tag'"." or ";
        }
    }
    $sql = "SELECT sv_video.sv_id,sv_video.title,sv_video.cover_img,sv_video.introduction,sv_video.cout_watch,user.userName FROM zjb LEFT JOIN tags ON tags.tagId = zjb.tagId LEFT JOIN sv_video ON  zjb.svId = sv_video.sv_id  LEFT JOIN user ON user.userId = sv_video.author WHERE ";
    $sql = $sql.$stringTags."ORDER BY sv_video.cout_watch limit 10";
    $result = query($sql);
    $videoArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($videoArray, $row);
        }
        echo  json_encode($videoArray);
    }
}
