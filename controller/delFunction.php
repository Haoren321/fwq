<?php
function delDir($path)
{
    if (is_dir($path)) {
        $handle = @opendir($path);
        while (($file = @readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $dir = $path . '/' . $file;
                @unlink($dir);
            }
        }
        closedir($handle);
        $res = rmdir($path);
        echo $res;
    }
}
