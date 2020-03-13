<?php
    $file = $_FILES['coverImg'];
    $fileName = $file['name'];
    $dir = $_POST['dir'];
    $path = '../video/tmp_video/'.$dir;
    $finish = move_uploaded_file($file['tmp_name'],"$path/$fileName");
    echo  $finish;
?>