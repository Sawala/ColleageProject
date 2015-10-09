<?php
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(!isset($_SESSION))
{
    session_start();
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	if(isset($_POST['redirect'])) 
	{
		header("location:".$_POST['redirect']);
	}
	else
	{
		header("Location: index.php");
	}
}

if(isset($_SESSION["loginMember"]))
{
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);	
	$row_RecMember=mysql_fetch_assoc($RecMember);
}

//檢查有無登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]==""))
{
?>
	<script language="javascript">
		alert('您尚未登入會員。\n請先登入會員，再進行評論動作。');
		window.location.href='member_index.php';		  
	</script>
<?php
}
else
{
	//檢查輸入訂單編號
	$query_RecOrder = "SELECT * FROM `order` WHERE `customername`='".$_SESSION["loginMember"]."'";
	$RecOrder = mysql_query($query_RecOrder);
	
	//檢查有無此訂單編號，以防亂評分
	$testflag = false;
	while($row_RecOrder=mysql_fetch_assoc($RecOrder))
	{
		if($row_RecOrder["orderid"]==$_POST["orderid"])
		{
			$testflag = true;
		}
	}
	//如果該客戶無此訂單編號，顯示錯誤
	if(!$testflag)
	{
		?>
		<script language="javascript">
			alert('您所登入的帳號並沒有對應的訂單編號，\n請檢查輸入的訂單編號是否正確，\n並且使用正確的帳號。');
			window.location.href='score.php';		  
		</script>
		<?php
	}
	
	$today = date("Y-m-d");
	//寫入評論資料
	if(isset($_POST["nickname"]) && isset($_POST["product"]) && isset($_POST["star"]) && isset($_POST["comment"]))
	{	
		$sql_query = "INSERT INTO `comment` (`memberid` , `nickname` , `date` ,`fruitid` ,`comment` ,`star`) VALUES (";
		$sql_query .= $row_RecMember["m_id"].",";
		$sql_query .= "'".$_POST["nickname"]."',";
		$sql_query .= "'".$today."',";
		$sql_query .= $_POST["product"].",";
		$sql_query .= "'".$_POST["comment"]."',";
		$sql_query .= $_POST["star"].")";
		mysql_query($sql_query);
	?>
	<script language="javascript">
		alert('謝謝您的評論\n按下確認鍵後返回網站首頁。');
		window.location.href='index.php';		  
	</script>
	<?php
	}
}
?>