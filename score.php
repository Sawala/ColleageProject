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
$query_RecNews = "SELECT * FROM `news` ORDER BY `newstime` DESC";
$RecNews = mysql_query($query_RecNews);

if(isset($_SESSION["loginMember"]))
{
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);	
	$row_RecMember=mysql_fetch_assoc($RecMember);
}

//拿中葉的平均分數、資料筆數
$query_RecScore1 = "SELECT AVG(`star`) FROM `comment` WHERE `fruitid` = '1' ";
$query_RecScore1Count = "SELECT COUNT(`star`) FROM `comment` WHERE `fruitid` = '1' ";
$RecScore1 = mysql_query($query_RecScore1);
$RecScore1Count = mysql_query($query_RecScore1Count);
$row_RecScore1=mysql_fetch_assoc($RecScore1);
$row_RecCount1=mysql_fetch_assoc($RecScore1Count);
foreach($row_RecScore1 as $item)
{
	$averagestar1 = $item;
	$averagestarli1 = $item*32;
}
foreach($row_RecCount1 as $item)
{
	$ScoreCount1 = $item;
}
//拿金桃的平均分數、資料筆數
$query_RecScore2 = "SELECT AVG(`star`) FROM `comment` WHERE `fruitid` = '2' ";
$query_RecScore2Count = "SELECT COUNT(`star`) FROM `comment` WHERE `fruitid` = '2' ";
$RecScore2 = mysql_query($query_RecScore2);
$RecScore2Count = mysql_query($query_RecScore2Count);
$row_RecScore2=mysql_fetch_assoc($RecScore2);
$row_RecCount2=mysql_fetch_assoc($RecScore2Count);
foreach($row_RecScore2 as $item)
{
	$averagestar2 = $item;
	$averagestarli2 = $item*32;
}
foreach($row_RecCount2 as $item)
{
	$ScoreCount2 = $item;
}
//拿蓮霧的平均分數、資料筆數
$query_RecScore3 = "SELECT AVG(`star`) FROM `comment` WHERE `fruitid` = '3' ";
$query_RecScore3Count = "SELECT COUNT(`star`) FROM `comment` WHERE `fruitid` = '3' ";
$RecScore3 = mysql_query($query_RecScore3);
$RecScore3Count = mysql_query($query_RecScore3Count);
$row_RecScore3=mysql_fetch_assoc($RecScore3);
$row_RecCount3=mysql_fetch_assoc($RecScore3Count);
foreach($row_RecScore3 as $item)
{
	$averagestar3 = $item;
	$averagestarli3 = $item*32;
}
foreach($row_RecCount3 as $item)
{
	$ScoreCount3 = $item;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	function SetEventStar1() 
    {
		document.getElementById('starvalue').value = document.getElementById('star1').value;
		document.getElementById('stardisabled').value = document.getElementById('star1').value;
	}
	function SetEventStar2() 
    {
		document.getElementById('starvalue').value = document.getElementById('star2').value;
		document.getElementById('stardisabled').value = document.getElementById('star2').value;
	}
	function SetEventStar3() 
    {
		document.getElementById('starvalue').value = document.getElementById('star3').value;
		document.getElementById('stardisabled').value = document.getElementById('star3').value;
	}
	function SetEventStar4() 
    {
		document.getElementById('starvalue').value = document.getElementById('star4').value;
		document.getElementById('stardisabled').value = document.getElementById('star4').value;
	}
	function SetEventStar5() 
    {
		document.getElementById('starvalue').value = document.getElementById('star5').value;
		document.getElementById('stardisabled').value = document.getElementById('star5').value;
	}
	
	function checkForm()
	{
		//訂單編號檢測
		if(document.formScore.orderid.value=="")
		{		
			alert("為防止惡意評分造成評分失真，\n請輸入訂單編號，\n若遺忘訂單編號請至訂購填寫之email查詢。");
			document.formScore.orderid.focus();
			return false;
		}
		else
		{
			uid=document.formScore.orderid.value;
			for(idx=0;idx<uid.length;idx++)
			{
				if(!(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9'))
				{
					alert( "您的訂單編號只能是數字，\n其他的符號都不能使用！" );
					document.formScore.orderid.focus();
					return false;
				}
			}
		}
		//暱稱檢測
		if(document.formScore.nickname.value=="")
		{
			alert("您未填寫使用者暱稱，\n使用者暱稱僅用於顯示此篇評論之評論者。");
			document.formScore.nickname.focus();
			return false;
		}
		//評分檢測
		if(document.formScore.star.value=="")
		{
			alert("您未給予水果分數！");
			document.formScore.star.focus();
			return false;
		}
		//評論內容檢測
		if(document.formScore.comment.value=='')
		{
			alert("評論內容不可以空白！");
			return false;
		}
		if(document.formScore.comment.value.length<8)
		{
			alert( "評論內容長度不足！\n只少輸入8個字元以上。" );
			return false;
		}
		if(document.formScore.comment.value.length>150)
		{
			alert( "評論內容長度超過！\n只能輸入150個字元。" );
			return false;
		}
		for(var idx=0;idx<document.formScore.comment.value.length;idx++)
		{
			if(document.formScore.comment.value.charAt(idx) == ' ' || document.formScore.comment.value.charAt(idx) == '\"' || document.formScore.comment.value.charAt(idx) == '\'' || document.formScore.comment.value.charAt(idx) == '(' || document.formScore.comment.value.charAt(idx) == ')')
			{
				alert("評論內容不可以含有空白、單雙引號或括弧！\n若需要使用單雙引號請用上下引號。");
				return false;
			}
		}
		return confirm('確定送出嗎？');
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
	<div id="LeftSide">
		<div id="News">
			<div id="NewsText">
				<?php
				while($row_RecNews=mysql_fetch_assoc($RecNews))
				{
			?>
				<p class="newswords"><strong><a href="news.php?newsid=<?php echo $row_RecNews["newsid"];?>"><?php echo $row_RecNews["newstime"];?>》</strong><?php echo $row_RecNews["title"]; ?></a></p>
			<?php
				}
			?>
				 
			</div>
		</div>
		<div id="SeasonFruit">
		<br><br><br>
			<div class="picDiv">
				<a href="product.php?id=1"><img src="proimg/蜜棗1.jpg" alt="中葉" width="90" height="90" border="0" /></a>
				<div class="smalltext">中葉</div>
			</div>
		</div>
		<div id="Visit">
			網站瀏覽人次<br>
			<script id="_waufc8">
				var _wau = _wau || [];_wau.push(["colored", "lfuhfq7tygdq", "fc8", "53ff33000000"]);
				(function() {var s=document.createElement("script"); s.async=true;
				s.src="http://widgets.amung.us/colored.js";
				document.getElementsByTagName("head")[0].appendChild(s);})();
			</script>
		</div>
		<div id="Visit">
			<div style="padding-top: 8%;">
				<a href="score.php" style="font-family: 微軟正黑體; font-size: 16pt;">我 要 評 分</a>
			</div>
		</div>
	</div>
	<div id="EachContent">
		<br><div class="subjectDiv">歡迎來到評分系統</div>
		<form name="formScore" id="formScore" method="post" action="scoreresult.php" onSubmit="return checkForm();">
		<br>
		<a class="titleDiv">日期：</a><?php echo date("Y-m-d");?><br>
		
		<?php
			if(isset($_SESSION["loginMember"]))
			{
			?>
			<a class="titleDiv">會員姓名：</a>
			<?php
				echo $row_RecMember["m_name"];
			}
		?>
		<p class="titleDiv">請輸入訂單編號：<input type = "text" name ="orderid" id="orderid" size="20"></p>
		<p class="titleDiv">暱稱：<input type = "text" name ="nickname" id="nickname" size="20"></p>
		<a class="titleDiv">我想要評分</a>
			<input type="radio" name="product" value="1" checked>中葉(蜜棗)
			<input type="radio" name="product" value="2">金桃(蜜棗)
			<input type="radio" name="product" value="3">蓮霧<br>
		<p class="titleDiv">我想要給此水果
			<input type = "text" name ="stardisabled" id="stardisabled" disabled="disabled" size="3">分
			<input type = "hidden" name ="star" id="starvalue" size="3"></p>
			<div style="float: left; width:32%">
				<a class="AdDiv">中葉</a>
				<br><br>
				<ul class='star-rating'>
					<li class='average-rating' style="width: <?php echo $averagestarli1; ?>px;"></li>
					<li id="star1" value="1"><a onclick="SetEventStar1()" title='1 star out of 5' class='one-star' value="1">1</a></li>
					<li id="star2" value="2"><a onclick="SetEventStar2()" title='2 star out of 5' class='two-stars' value="2">2</a></li>
					<li id="star3" value="3"><a onclick="SetEventStar3()" title='3 star out of 5' class='three-stars' value="3">3</a></li>
					<li id="star4" value="4"><a onclick="SetEventStar4()" title='4 star out of 5' class='four-stars' value="4">4</a></li>
					<li id="star5" value="5"><a onclick="SetEventStar5()" title='5 star out of 5' class='five-stars' value="5">5</a></li>
				</ul>
				<br>
				<a class="titleDiv">平均分數：</a><a class="AdDiv"><?php echo sprintf("%.1f",$averagestar1);?></a><a class="titleDiv">分</a><br>
				<a class="titleDiv">共</a><a class="AdDiv"><?php echo $ScoreCount1; ?></a><a class="titleDiv">票</a>
			</div>
			<div style="float: left; width:32%">
				<a class="AdDiv">金桃</a>
				<br><br>
				<ul class='star-rating'>
					<li class='average-rating' style="width: <?php echo $averagestarli2; ?>px;"></li>
					<li id="star1" value="1"><a onclick="SetEventStar1()" title='1 star out of 5' class='one-star' value="1">1</a></li>
					<li id="star2" value="2"><a onclick="SetEventStar2()" title='2 star out of 5' class='two-stars' value="2">2</a></li>
					<li id="star3" value="3"><a onclick="SetEventStar3()" title='3 star out of 5' class='three-stars' value="3">3</a></li>
					<li id="star4" value="4"><a onclick="SetEventStar4()" title='4 star out of 5' class='four-stars' value="4">4</a></li>
					<li id="star5" value="5"><a onclick="SetEventStar5()" title='5 star out of 5' class='five-stars' value="5">5</a></li>
				</ul>
				<br>
				<a class="titleDiv">平均分數：</a><a class="AdDiv"><?php echo sprintf("%.1f",$averagestar2);?></a><a class="titleDiv">分</a><br>
				<a class="titleDiv">共</a><a class="AdDiv"><?php echo $ScoreCount2; ?></a><a class="titleDiv">票</a>
			</div>
			<div style="float: left; width:32%">
				<a class="AdDiv">蓮霧</a>
				<br><br>
				<ul class='star-rating'>
					<li class='average-rating' style="width: <?php echo $averagestarli3; ?>px;"></li>
					<li id="star1" value="1"><a onclick="SetEventStar1()" title='1 star out of 5' class='one-star' value="1">1</a></li>
					<li id="star2" value="2"><a onclick="SetEventStar2()" title='2 star out of 5' class='two-stars' value="2">2</a></li>
					<li id="star3" value="3"><a onclick="SetEventStar3()" title='3 star out of 5' class='three-stars' value="3">3</a></li>
					<li id="star4" value="4"><a onclick="SetEventStar4()" title='4 star out of 5' class='four-stars' value="4">4</a></li>
					<li id="star5" value="5"><a onclick="SetEventStar5()" title='5 star out of 5' class='five-stars' value="5">5</a></li>
				</ul>
				<br>
				<a class="titleDiv">平均分數：</a><a class="AdDiv"><?php echo sprintf("%.1f",$averagestar3);?></a><a class="titleDiv">分</a><br>
				<a class="titleDiv">共</a><a class="AdDiv"><?php echo $ScoreCount3; ?></a><a class="titleDiv">票</a><br><br>
			</div>
			<p class="titleDiv" style="clear:both;">我要評論：</p>
			<textarea name="comment" rows="5" cols="40"></textarea><br>
		<input type = "submit" value = "送出" />
		<input type = "reset" value = "重新填寫" />
	</div>
</form>
</div>
	<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
