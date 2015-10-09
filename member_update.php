<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(!isset($_SESSION))
{
    session_start();
}
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: member_index.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: member_index.php");
}
//重新導向頁面
$redirectUrl="member_center.php";
//執行更新動作
if(isset($_POST["action"])&&($_POST["action"]=="update")){	
	$query_update = "UPDATE `memberdata` SET ";
	//若有修改密碼，則更新密碼。
	if(($_POST["m_passwd"]!="")&&($_POST["m_passwd"]==$_POST["m_passwdrecheck"])){
		$query_update .= "`m_passwd`='".$_POST["m_passwd"]."',";
	}	
	$query_update .= "`m_name`='".$_POST["m_name"]."',";	
	$query_update .= "`m_sex`='".$_POST["m_sex"]."',";
	$query_update .= "`m_birthday`='".$_POST["m_birthday"]."',";
	$query_update .= "`m_email`='".$_POST["m_email"]."',";
	$query_update .= "`m_phone`='".$_POST["m_phone"]."',";
	$query_update .= "`m_address`='".$_POST["m_address"]."' ";
	$query_update .= "WHERE `m_id`=".$_POST["m_id"];	
	mysql_query($query_update);
	//若有修改密碼，則登出回到首頁。
	if(($_POST["m_passwd"]!="")&&($_POST["m_passwd"]==$_POST["m_passwdrecheck"])){
		unset($_SESSION["loginMember"]);
		unset($_SESSION["memberLevel"]);
		$redirectUrl="member_index.php";
	}		
	//重新導向
	header("Location: $redirectUrl");
}

//繫結登入會員資料
if(isset($_SESSION["loginMember"]))
{
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);	
	$row_RecMember=mysql_fetch_assoc($RecMember);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function checkForm(){
	if(document.formJoin.m_passwd.value!="" || document.formJoin.m_passwdrecheck.value!=""){
		if(!check_passwd(document.formJoin.m_passwd.value,document.formJoin.m_passwdrecheck.value)){
			document.formJoin.m_passwd.focus();
			return false;
		}
	}	
	if(document.formJoin.m_name.value==""){
		alert("請填寫姓名!");
		document.formJoin.m_name.focus();
		return false;
	}
	if(document.formJoin.m_birthday.value==""){
		alert("請填寫生日!");
		document.formJoin.m_birthday.focus();
		return false;
	}
	if(document.formJoin.m_email.value==""){
		alert("請填寫電子郵件!");
		document.formJoin.m_email.focus();
		return false;
	}
	if(!checkmail(document.formJoin.m_email)){
		document.formJoin.m_email.focus();
		return false;
	}
	return confirm('確定送出嗎？');
}
function check_passwd(pw1,pw2){
	if(pw1==''){
		alert("密碼不可以空白!");
		return false;
	}
	for(var idx=0;idx<pw1.length;idx++){
		if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
			alert("密碼不可以含有空白或雙引號 !\n");
			return false;
		}
		if(pw1.length<4 || pw1.length>12){
			alert( "密碼長度只能4到12個字母 !\n" );
			return false;
		}
		if(pw1!= pw2){
			alert("密碼二次輸入不一樣,請重新輸入 !\n");
			return false;
		}
	}
	return true;
}
function checkmail(myEmail) {
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(filter.test(myEmail.value)){
		return true;
	}
	alert("電子郵件格式不正確");
	return false;
}
</script>
</head>

<body>
<div id="Content" align="center">
<div id="MemberSystem" align="right">
	<?php //如果有登入
			if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
		?>
            <a>親愛的　<strong><?php echo $row_RecMember["m_name"];?></strong>　您好 </a>
			　|　<a href="member_update.php">修改資料</a>
			　|　<a href="?logout=true">登出</a>
			　|　<a href="cart.php">購物車　<img src="images/cart4.png" align="middle"></a>　
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
	<a href="index.php"><img src="images/LOGO.jpg"/></a>
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
	<br><div class="subjectDiv">會員資料修改</div>
	<form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
            <div style="float: left; width:500px; height:340px;">
            <p class="heading">帳號資料</p>
            <p><strong>使用者帳號</strong>
              ：<?php echo $row_RecMember["m_username"];?></p>
            <p><strong>使用者密碼</strong> ：
              <input name="m_passwd" type="password" class="normalinput" id="m_passwd">
              <br><span class="smalltext">若不需修改密碼，請不要填寫。<br>若要修改，請輸入密碼4~12個字元。</span>
            </p>
            <p><strong>確認密碼</strong> ：
              <input name="m_passwdrecheck" type="password" class="normalinput" id="m_passwdrecheck">
              <br><span class="smalltext">再輸入一次密碼</span></p>
			<p><br><font color="#FF0000">*</font> 表示為必填的欄位</p>
            </div>
			<div style="float: left; width:400px; height:340px;">
            <p class="heading">個人資料</p>
            <p><strong>姓名</strong>：
                <input name="m_name" type="text" class="normalinput" id="m_name" value="<?php echo $row_RecMember["m_name"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>性別
              </strong>：
              <input name="m_sex" type="radio" value="女" <?php if($row_RecMember["m_sex"]=="女") echo "checked";?>>
              女
  <input name="m_sex" type="radio" value="男" <?php if($row_RecMember["m_sex"]=="男") echo "checked";?>>
              男 <font color="#FF0000">*</font></p>
            <p><strong>生日</strong>：
                <input name="m_birthday" type="text" class="normalinput" id="m_birthday" value="<?php echo $row_RecMember["m_birthday"];?>">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">西元格式(YYYY-MM-DD)。 </span></p>
            <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="normalinput" id="m_email" value="<?php echo $row_RecMember["m_email"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>電話</strong>：
                <input name="m_phone" type="text" class="normalinput" id="m_phone" value="<?php echo $row_RecMember["m_phone"];?>">
            </p>
            <p><strong>住址</strong>：
                <input name="m_address" type="text" class="normalinput" id="m_address" value="<?php echo $row_RecMember["m_address"];?>" size="40">
            </p>
          </div>
          <p align="center">
            <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMember["m_id"];?>">
            <input name="action" type="hidden" id="action" value="update">
            <input type="submit" class="button11" name="Submit2" value="確認修改資料">
            <input type="reset" class="button11" name="Submit3" value="回復初始資料">
            <input type="button" class="button11" name="Submit" value="回上一頁" onClick="window.history.back();">
          </p>
        </form>
</div>
  <div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
