<?php
require "../ben/dbConnect.php";
$code = $_POST['code'];
if ($code ==  "cateforyItem") {
    $item = $_POST['cateforItem'];
    getVideoArray($item);
}
function getVideoArray($item)
{
    switch ($item) {
        case 'comic':
            $itemTag = '动画';
            break;
        case 'game':
            $itemTag = '游戏';
            break;
        case 'music':
            $itemTag = '音乐';
            break;
        case 'learn':
            $itemTag = '学习';
            break;
        case 'rank':
            $itemTag = 'rank';
            break;    
        default:
            # code...
            break;
    }
    dbInit();
    $sql = "SELECT * FROM zjb LEFT JOIN tags ON tags.tagId = zjb.tagId LEFT JOIN sv_video ON  zjb.svId = sv_video.sv_id WHERE tags.tagName = '$itemTag'";
    if($itemTag == "rank"){
        $sql = "SELECT sv_video.*,user.userName FROM `sv_video` LEFT JOIN user on sv_video.author = user.userId ORDER BY `sv_video`.`cout_watch`  DESC  LIMIT 50";
    }
    $result = query($sql);
    $videoArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($videoArray, $row);
        }
        echo  json_encode($videoArray);
    }
}
