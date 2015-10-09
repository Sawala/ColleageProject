<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(!isset($_SESSION))
{
    session_start();
}
include("PHPMailer_5.2.1/class.phpmailer.php"); //匯入PHPMailer類別
   
   $mail= new PHPMailer();//建立新物件
   $mail->IsSMTP();//設定使用SMTP方式寄信
   $mail->SMTPAuth = true; //設定SMTP需要驗證
   $mail->SMTPSecure = "ssl";// Gmail的SMTP主機需要使用SSL連線
   $mail->Host = "smtp.gmail.com";  //Gamil的SMTP主機
   $mail->Port = 465;//Gamil的SMTP主機的SMTP埠位為465埠。
   $mail->CharSet = "utf-8";//設定郵件編碼        

   $mail->Username = "ncuisqlab12";  //Gmail帳號
   $mail->Password = "misteam12";  //Gmail密碼        

   $mail->From = "ncuisqlab12@gmail.com"; //設定寄件者信箱
   $mail->FromName = "尋棗/張家果園";//設定寄件者姓名
   $mail->Subject = "忘記密碼認證信"; //設定郵件標題
//函式：自動產生指定長度的密碼
function MakePass($length) { 
	$possible = "0123456789+abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	$str = ""; 
	while(strlen($str)<$length){ 
	  $str .= substr($possible, rand(0, strlen($possible)), 1); 
	}
	return($str); 
}
//檢查是否經過登入，若有登入則重新導向
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
	//若帳號等級為 member 則導向會員中心
	if($_SESSION["memberLevel"]=="member"){
		header("Location: member_index.php");
	}
}
//檢查是否為會員
if(isset($_POST["m_username"])){	
	//找尋該會員資料
	$query_RecFindUser = "SELECT * FROM `memberdata` WHERE `m_username`='".$_POST["m_username"]."'";
	$RecFindUser = mysql_query($query_RecFindUser);
	if (mysql_num_rows($RecFindUser)==0){
		header("Location: member_passmail.php?errMsg=1");
	}
	//取出帳號密碼的值
	$row_RecFindUser=mysql_fetch_assoc($RecFindUser);
	$username = $row_RecFindUser["m_username"];
	$usermail = $row_RecFindUser["m_email"];
	$userpassword = $row_RecFindUser["m_passwd"];
	/*if(isset($_POST["m_passwd"]))
	{
		if($_POST["m_passwd"]==$userpassword)
		{*/
			//產生新密碼並更新
			$newpasswd = MakePass(10);
			$query_update = "UPDATE `memberdata` SET `m_passwd`='".$newpasswd."' WHERE `m_username`='".$username."'";
			mysql_query($query_update);
			//補寄密碼信
			$mail->Body = "您好，<br />您的帳號為：$username <br/>您的新密碼為：$newpasswd <br/>";//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
			
			$mail->IsHTML(true);//設定郵件內容為HTML
			$mail->AddAddress($usermail, $username); //設定收件者郵件及名稱

			if(!$mail->Send()){
			echo "寄信發生錯誤：" . $mail->ErrorInfo;
			//如果有錯誤會印出原因
			}
			else{
				echo "寄信成功";
			}
			/*
			$mailcontent ="您好，<br />您的帳號為：$username <br/>您的新密碼為：$newpasswd <br/>";
			$mailFrom="=?UTF-8?B?" . base64_encode("尋棗/張家果園") . "?= <ncuisqlab12@gmial.com>";
			$mailto=$usermail;
			$mailSubject="=?UTF-8?B?" . base64_encode("忘記密碼認證信"). "?= <ncuisqlab12@gmail.com>";
			$mailHeader="From:".$mailFrom."\r\n";
			$mailHeader.="Content-type:text/html;charset=UTF-8";
			mail($mailto,$mailSubject,$mailcontent,$mailHeader);
			if(!@mail($mailto,$mailSubject,nl2br($mailcontent),$mailHeader)) die("郵寄失敗！");
			else header("Location: member_passmail.php?mailStats=1");*/
		/*}
		else
		{
			header("Location: member_passmail.php?errMsg=1");
		}
	}*/
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
            <li><a href="scenery.php">鹽埔風景</a></li>
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
<?php if(isset($_GET["mailStats"]) && ($_GET["mailStats"]=="1")){?>
<script>
alert('密碼信補寄成功！');
window.location.href='member_index.php';		  
</script>
<?php }?>
          <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          <div class="infoDiv">請正確輸入原始帳號或密碼</div>
          <?php }?>
          <div class="subjectDiv">忘記密碼？</div>
          <form name="form1" method="post" action="">
            <p class="titleDiv">請輸入您申請的帳號，系統將自動產生一組新密碼至您註冊時的信箱。</p>
            <p>帳號：
              <br>
              <input name="m_username" type="text" class="logintextbox" id="m_mail">
            </p>
			<?php /*<p>原始密碼：<br>
              <input name="m_passwd" type="password" class="logintextbox" id="passwd">
			</p>*/ ?>
            <p align="center">
              <input type="submit" class="button11" name="button" id="button" value="寄密碼信">
              <input type="button" class="button11" name="button2" id="button2" value="回上一頁" onClick="window.history.back();">
            </p>
            </form>
</div>
</div>
</body>
</html>
