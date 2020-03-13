<?php
	header("content-type:text/html;charset=utf-8");
	//连接数据库
	$link;
	dbInit();
	function dbInit()
	{
		global $link;
		$index = 0;
		$dbAdress = 'localhost';
		$name = 'Haoren';
		$pwd = 'admin2312';
		$dbName = 'bysjData';
			
		$link = mysqli_connect($dbAdress,$name,$pwd,$dbName);
		if (!$link) {
			die('连接数据库失败'.mysqli_error($link));
		}
		mysqli_set_charset($link,"utf8");		
	}
	//防注入攻击
	function safeHandle($data)
	{
		global $link;
		$data = htmlspecialchars($data);
	    $data = mysqli_real_escape_string($link,$data);
	    return $data;
	}
	function query($sql){
	global $link;
    if($result = mysqli_query($link,$sql)){
        return $result;
	}else if(mysqli_errno($link)==1062){
		echo "该手机号已被注册过";
	}
	else{
    	global $link;
        echo 'SQL执行失败:<br>';
        echo '错误的SQL为：', $sql ,'<br>';
        echo '错误的代码为：', mysqli_errno($link) ,'<br>';
        echo '错误的信息为：', mysqli_error($link) ,'<br>';
        die;
    }
}
?>