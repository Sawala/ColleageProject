<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(!isset($_SESSION))
{
    session_start();
}
if(isset($_REQUEST["Turing"]))
{
	$usercaptcha = $_REQUEST["Turing"];
}
//檢查是否經過登入，若有登入則重新導向
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
	//若帳號等級為 member 則導向會員中心
	if($_SESSION["memberLevel"]=="member"){
		header("Location: index.php");
	}
}
//執行會員登入
if(isset($_POST["username"]) || isset($_POST["passwd"]))
{		
	//繫結登入會員資料
	$query_RecLogin = "SELECT * FROM `memberdata` WHERE `m_username`='".$_POST["username"]."'";
	$RecLogin = mysql_query($query_RecLogin);		
	//取出帳號密碼的值
	$row_RecLogin=mysql_fetch_assoc($RecLogin);
	$username = $row_RecLogin["m_username"];
	$passwd = $row_RecLogin["m_passwd"];
	$level = $row_RecLogin["m_level"];
	//比對帳號、密碼，若登入成功則呈現登入狀態
	if($_POST["username"] == $username && $_POST["passwd"]==$passwd)
	{
		//比對驗證碼
		if(strtoupper($_SESSION['turing_string']) == strtoupper($usercaptcha))
		{
			//設定登入者的名稱及等級
			$_SESSION["loginMember"]=$username;
			$_SESSION["memberLevel"]=$level;
			//若帳號等級為 member 則導向會員中心
			if($_SESSION["memberLevel"]=="member")
			{
				if ($_POST['redirect']) 
				{
					header("location:".$_POST['redirect']."");
				}
				else
				{
					header("Location: index.php");
				}
			}
			//否則則導向管理中心
		}
		else
		{
			header("Location: member_index.php?errMsg=2");
		}
	}
	else
	{
		header("Location: member_index.php?errMsg=1");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="Content" align="center">
	<div id="MemberSystem" align="right">
	<?php //如果有登入
			if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
		?>
            <a>親愛的　<strong><?php echo $row_RecMember["m_name"];?></strong>　您好 </a>
			　|　<a href="?logout=true">會員登出</a>
			　|　<a href="cart.php">我的購物車</a>　
		<?php
			}else{ //如果沒登入，顯示登入視窗
		?>
			<a href="member_index.php">會員中心</a>
			　|　<a href="cart.php">購物車　<img src="images/cart4.png" align="middle"></a>　
		<?php
			}
		?>
	</div>
	<div id="Logo">
		<a href="index.php"><img src="images/LOGO.jpg"/></a></a>
	</div>
<div id="Menu">
   <ul>
      <li class="parent" onMouseOver="this.className='parentOn'" onMouseOut="this.className='parent'"><a href="aboutus.php">關於我們</a>
      	<ul>
        	<li><a href="farmintro.php">果園介紹</a></li>
            <li><a href="goals.php">經營理念</a></li>
        </ul>    
      </li>
      <li class="parent" onMouseOver="this.className='parentOn'" onMouseOut="this.className='parent'"><a href="showproduct.php">果園產品</a>
      	<ul>
        	<li><a href="showproduct.php?cid=1">蜜棗</a></li>
            <li><a href="showproduct.php?cid=2">蓮霧</a></li>
        </ul>    
      </li>
      <li class="parent" onMouseOver="this.className='parentOn'" onMouseOut="this.className='parent'"><a href="intro.php">鹽埔之美</a>
      	<ul>
        	<li><a href="intro.php">鹽埔小學堂</a></li>
			<li><a href="landmark.php">景點介紹</a></li>
            <li><a href="scenery.php">鹽埔藝廊</a></li>
        </ul>    
      </li>
		<li><a href="route.php">行程建議</a></li>
		<li class="parent" onMouseOver="this.className='parentOn'" onMouseOut="this.className='parent'"><a href="douknow.php">你知道嗎</a>
		<ul>
			<li><a href="fruitdic.php">水果小百科</a></li>
		</ul>
		</li>
      <li class="parent" onMouseOver="this.className='parentOn'" onMouseOut="this.className='parent'"><a href="process.php">訂購須知</a>
      	<ul>
            <li><a href="paydelivery.php">付款說明</a></li>
			<li><a href="delivery.php">商品運送</a></li>
        </ul> 
      </li>
	  <li><a href="customerservice.php">客服中心</a></li>
      <li class="parent" onMouseOver="this.className='parentOn'" onMouseOut="this.className='parent'"><a href="bigbirdhome.php">大鴕家介紹</a>
      	<ul>
        	<li><a href="bigbird.php">認識鴕鳥</a></li>
            <li><a href="yenpubigbird.php">鴕鳥與鹽埔</a></li>
            <li><a href="gobigbird.php">交通資訊</a></li>
        </ul>    
      </li>
	  <li><a href="messageboard.php">水果留言板</a></li>
    </ul>
</div>
	<div id="SubPage">
		<br><div class="subjectDiv">登入會員</div>
  <?php //如果有登入
			if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
		?>
			<br><br><br>
            <p>親愛的　<strong><?php echo $row_RecMember["m_name"];?></strong>　您好</p>
			<p><a href="member_update.php">修改資料</a>　|　<a href="?logout=true">會員登出</a></p><p><a class="heading" href="cart.php"><img src="images/cart.png" height="90px" width="90px" style="border:0px;"/><br>我的購物車</a></p>
		<?php
			}else{ //如果沒登入，顯示登入視窗
		 if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          <div class="infoDiv">帳號或密碼錯誤！</div>
          <?php }
		  if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="2")){?>
		  <div class="infoDiv">圖形驗證碼錯誤！</div>
		  <?php }?>
          <form name="form1" method="post" action="">
            <p>帳號：
              <br>
              <input name="username" type="text" class="logintextbox" id="username" value="<?php if(isset($_COOKIE["remUser"])){echo $_COOKIE["remUser"];}?>">
            </p>
            <p>密碼：<br>
              <input name="passwd" type="password" class="logintextbox" id="passwd" value="<?php if(isset($_COOKIE["remPass"])){echo $_COOKIE["remPass"];}?>">
            </p>
			<p>請輸入驗證碼：<br>
				<input name="Turing" type="text" class="logintextbox" value="">
				<br>
				<img src="./googlecaptcha/code.php" id="captcha">
            </p>
			<a href="#" onclick="document.getElementById('captcha').src = document.getElementById('captcha').src + '?' + (new Date()).getMilliseconds()">看不清楚嗎？按這裡重新整理</a>
			<p align="center"><a href="member_passmail.php">忘記密碼</a></p>
            <p align="center">
              <input type="submit" class="button11" name="button" id="button" value="會員登入">
			  <input type="hidden" name="redirect" value="<?=$_SERVER["HTTP_REFERER"]?>">
            </p>
            </form>
          <p align="center"><a href="member_agreement.php">註冊會員</a></p>
		  <?php
			}
		?>
	</div>
		<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
	</div>
</body>
</html>
