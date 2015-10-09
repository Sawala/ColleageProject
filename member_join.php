<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(isset($_POST["action"])&&($_POST["action"]=="join")){
	//找尋帳號是否已經註冊
	$query_RecFindUser = "SELECT `m_username` FROM `memberdata` WHERE `m_username`='".$_POST["m_username"]."'";
	$RecFindUser=mysql_query($query_RecFindUser);
	if (mysql_num_rows($RecFindUser)>0){
		header("Location: member_join.php?errMsg=1&username=".$_POST["m_username"]);
	}else{
	//若沒有執行新增的動作	
		$query_insert = "INSERT INTO `memberdata` (`m_name` ,`m_username` ,`m_passwd` ,`m_sex` ,`m_birthday` ,`m_email`,`m_phone`,`m_address`) VALUES (";
		$query_insert .= "'".$_POST["m_name"]."',";
		$query_insert .= "'".$_POST["m_username"]."',";
		$query_insert .= "'".$_POST["m_passwd"]."',";
		$query_insert .= "'".$_POST["m_sex"]."',";
		$query_insert .= "'".$_POST["m_birthday"]."',";
		$query_insert .= "'".$_POST["m_email"]."',";
		$query_insert .= "'".$_POST["m_phone"]."',";
		$query_insert .= "'".$_POST["m_address"]."')";
		mysql_query($query_insert);
		header("Location: member_join.php?loginStats=1");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function checkForm(){
	if(document.formJoin.m_username.value==""){		
		alert("請填寫帳號!");
		document.formJoin.m_username.focus();
		return false;
	}else{
		uid=document.formJoin.m_username.value;
		if(uid.length<4 || uid.length>12){
			alert( "您的帳號長度只能4至12個字元!" );
			document.formJoin.m_username.focus();
			return false;
		}
		if(!(uid.charAt(0)>='a' && uid.charAt(0)<='z')){
			alert("您的帳號第一字元只能為小寫字母!" );
			document.formJoin.m_username.focus();
			return false;
		}
		for(idx=0;idx<uid.length;idx++){
			if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
				alert("帳號不可以含有大寫字元!" );
				document.formJoin.m_username.focus();
				return false;
			}
			if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
				alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
				document.formJoin.m_username.focus();
				return false;
			}
			if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
				alert( "「_」符號不可相連 !\n" );
				document.formJoin.m_username.focus();
				return false;				
			}
		}
	}
	if(!check_passwd(document.formJoin.m_passwd.value,document.formJoin.m_passwdrecheck.value)){
		document.formJoin.m_passwd.focus();
		return false;
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
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('加入會員成功！\n點取確認鍵後返回首頁。');
window.location.href='index.php';		  
</script>
<?php }?>
		<div class="subjectDiv"><br>註冊會員</div>
		<form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
          
		  <div style="float: left; width:450px; height:340px;">
		  <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          <div class="errDiv">帳號 <?php echo $_GET["username"];?> 已經有人使用！</div>
          <?php }?>
            <p class="heading">帳號資料</p>
            <p><strong>使用者帳號</strong>：
                <input name="m_username" type="text" class="normalinput" id="m_username">
                <font color="#FF0000">*</font><br>
                <span class="smalltext">請填入4~12個字元以內的小寫英文字母、數字、以及_ 符號。</span></p>
            <p><strong>使用者密碼</strong>：
                <input name="m_passwd" type="password" class="normalinput" id="m_passwd">
                <font color="#FF0000">*</font><br>
                <span class="smalltext">請填入4~12個字元以內的英文字母、數字，或是符號。</span></p>
            <p><strong>確認密碼</strong>：
                <input name="m_passwdrecheck" type="password" class="normalinput" id="m_passwdrecheck">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">再輸入一次密碼</span></p>
			<p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
			</div>
			<div style="float: right; width:450px; height:340px;">
            <p class="heading">個人資料</p>
            <p><strong>姓名</strong>：
                <input name="m_name" type="text" class="normalinput" id="m_name">
                <font color="#FF0000">*</font> </p>
            <p><strong>性別
              </strong>：
              <input name="m_sex" type="radio" value="女" checked>
              女
  <input name="m_sex" type="radio" value="男">
              男 <font color="#FF0000">*</font></p>
            <p><strong>生日</strong>：
                <input name="m_birthday" type="text" class="normalinput" id="m_birthday">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">西元格式(YYYY-MM-DD)。</span></p>
            <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="normalinput" id="m_email">
                <font color="#FF0000">*</font> </p>
            <p><strong>電話</strong>：
                <input name="m_phone" type="text" class="normalinput" id="m_phone">
            </p>
            <p><strong>住址</strong>：
                <input name="m_address" type="text" class="normalinput" id="m_address" size="40">
            </p>
          </div>
		  <p align="center">
            <input name="action" type="hidden" id="action" value="join">
            <input type="submit" name="Submit2" value="送出申請">
            <input type="reset" name="Submit3" value="重設資料">
            <input type="button" name="Submit" value="回上一頁" onClick="window.history.back();">
          </p>
        </form>
</div>
  <div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
