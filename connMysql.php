﻿<?php 
	//資料庫主機設定
	$db_host = "localhost";
	$db_table = "fruit";
	$db_username = "root";
	$db_password = "1234";
	//設定資料連線
	if (!@mysql_connect($db_host, $db_username, $db_password)) die("資料連結失敗！");
	//連接資料庫
	if (!@mysql_select_db($db_table)) die("資料庫選擇失敗！");
	//設定字元集與連線校對
	mysql_query("SET NAMES 'utf8'");
?>
