<?php
    $_file = $_FILES['file'];
    if($_file != null){
        $currentIndex = $_POST['currentIndex'];//当前切片
        //$_file = $_FILES['file'];
        $name = $_file['name'];//文件名
        $type = explode("/",$_POST['fileType'])[1] ;//文件类型
        $total = $_POST['total'];//总的切片数
        $orginalName = $_POST['orginalName'];//文件的原始名字
        $fileMd5 = $_POST['fileMd5'];//文件的唯一标识
        $tmp_path = "../video/tmp_video/".$fileMd5;//切片存放位置
        if($currentIndex == 1){
            mkdir($tmp_path,0777,true);
        }
        move_uploaded_file($_file['tmp_name'],"$tmp_path/$name");
        if($currentIndex == $total){
            touch("$tmp_path/$orginalName");
            $mergeFile = "$tmp_path/$orginalName";
            for($i=0;$i< $total;$i++){
                $filePath = $tmp_path.'/'.$fileMd5.$i;
                $fp = fopen($mergeFile,"ab" );
                $handle = fopen($filePath,"rb");
                fwrite($fp,fread($handle,filesize($filePath)));
                fclose($handle);
                unlink($filePath);
            }
        }
        echo $currentIndex;
    }
?>
