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
//拿中葉的所有欄位、資料筆數
$query_RecScore1 = "SELECT * FROM `comment` WHERE `fruitid` = '1' ORDER BY `commentid` DESC";
$query_RecScore1Count = "SELECT COUNT(`star`) FROM `comment` WHERE `fruitid` = '1' ";
$RecScore1 = mysql_query($query_RecScore1);
$RecScore1Count = mysql_query($query_RecScore1Count);
$row_RecCount1=mysql_fetch_assoc($RecScore1Count);
foreach($row_RecCount1 as $item)//取得中葉評論的筆數
{
	$ScoreCount1 = $item;
}
//拿金桃的平均分數、資料筆數
$query_RecScore2 = "SELECT * FROM `comment` WHERE `fruitid` = '2' ";
$query_RecScore2Count = "SELECT COUNT(`star`) FROM `comment` WHERE `fruitid` = '2' ";
$RecScore2 = mysql_query($query_RecScore2);
$RecScore2Count = mysql_query($query_RecScore2Count);
$row_RecCount2=mysql_fetch_assoc($RecScore2Count);
foreach($row_RecCount2 as $item)
{
	$ScoreCount2 = $item;
}

//拿蓮霧的平均分數、資料筆數
$query_RecScore3 = "SELECT * FROM `comment` WHERE `fruitid` = '3' ";
$query_RecScore3Count = "SELECT COUNT(`star`) FROM `comment` WHERE `fruitid` = '3' ";
$RecScore3 = mysql_query($query_RecScore3);
$RecScore3Count = mysql_query($query_RecScore3Count);
$row_RecCount3=mysql_fetch_assoc($RecScore3Count);
foreach($row_RecCount3 as $item)
{
	$ScoreCount3 = $item;
}
//預設每頁筆數
$pageRow_records = 3;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages -1) * $pageRow_records;
//若有分類關鍵字時未加限制顯示筆數的SQL敘述句
$query_RecProduct1 = "SELECT * FROM `comment` WHERE `fruitid` = '1' ORDER BY `commentid` DESC";
$query_RecProduct2 = "SELECT * FROM `comment` WHERE `fruitid` = '2' ORDER BY `commentid` DESC";
$query_RecProduct3 = "SELECT * FROM `comment` WHERE `fruitid` = '3' ORDER BY `commentid` DESC";
$query_limit_RecProduct1 = $query_RecProduct1." LIMIT ".$startRow_records.", ".$pageRow_records;
$query_limit_RecProduct2 = $query_RecProduct2." LIMIT ".$startRow_records.", ".$pageRow_records;
$query_limit_RecProduct3 = $query_RecProduct3." LIMIT ".$startRow_records.", ".$pageRow_records;
if(isset($_GET['page']))
{
	if($_GET['page'] > 1)
	{
		$testcount1 = ceil($ScoreCount1/$pageRow_records);//測試結果 = (總資料筆數/分頁)無條件進位
		$testcount2 = ceil($ScoreCount2/$pageRow_records);
		$testcount3 = ceil($ScoreCount3/$pageRow_records);
		if($testcount1 < $_GET['page'])//如果測試結果 < 現有頁數，代表中葉沒有足夠資料可以顯示，則預設為顯示第一頁
		{
			$query_limit_RecProduct1 = $query_RecProduct1." LIMIT 0 , 3";//取第一頁的資料
		}
		if($testcount2 < $_GET['page'])//如果測試結果 < 現有頁數，代表金桃沒有足夠資料可以顯示，則預設為顯示第一頁
		{
			$query_limit_RecProduct2 = $query_RecProduct2." LIMIT 0 , 3";//取第一頁的資料
		}
		if($testcount3 < $_GET['page'])//如果測試結果 < 現有頁數，代表蓮霧沒有足夠資料可以顯示，則預設為顯示第一頁
		{
			$query_limit_RecProduct3 = $query_RecProduct3." LIMIT 0 , 3";//取第一頁的資料
		}
	}
}
$RecProduct1 = mysql_query($query_limit_RecProduct1);
$RecProduct2 = mysql_query($query_limit_RecProduct2);
$RecProduct3 = mysql_query($query_limit_RecProduct3);
$query_RecProduct_all = "SELECT * FROM `comment` ORDER BY `commentid` DESC";
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_RecProduct 中
$all_RecProduct = mysql_query($query_RecProduct_all);
//計算總筆數
$total_records = mysql_num_rows($all_RecProduct);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records);
//計算資料總筆數
$query_RecTotal = "SELECT count(`fruitid`)as totalNum FROM `comment`";
$RecTotal = mysql_query($query_RecTotal);
$row_RecTotal=mysql_fetch_assoc($RecTotal);
//返回 URL 參數
function keepURL(){
	$keepURL = "";
	if(isset($_GET["pid"])) $keepURL.="&pid=".$_GET["pid"];
	return $keepURL;
}

//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages1 = ceil($ScoreCount1/$pageRow_records);
$total_pages2 = ceil($ScoreCount2/$pageRow_records);
$total_pages3 = ceil($ScoreCount3/$pageRow_records);

if(isset($_SESSION["loginMember"]))
{
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);	
	$row_RecMember=mysql_fetch_assoc($RecMember);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function clearLinkDot() {
	var i, a, main;
	for(i=0; (a = document.getElementsByTagName("a")[i]); i++) {
		if(a.getAttribute("onFocus")==null) {
			a.setAttribute("onFocus","this.blur();");
		}else{
			a.setAttribute("onFocus",a.getAttribute("onFocus")+";this.blur();");
		}
		a.setAttribute("hideFocus","hidefocus");
	}
}

function loadTab(obj,n){
	var layer;
	eval('layer=\'S'+n+'\'');

	//將 Tab 標籤樣式設成 Blur 型態
	var tabsF=document.getElementById('tabsF').getElementsByTagName('li');
	for (var i=0;i<tabsF.length;i++){
		tabsF[i].setAttribute('id',null);
		eval('document.getElementById(\'S'+(i+1)+'\').style.display=\'none\'')
	}

	//變更分頁標題樣式
	obj.parentNode.setAttribute('id','current');
	document.getElementById(layer).style.display='inline';
}
</script>
</head>
<body onload="clearLinkDot();">
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
		<br><div class="subjectDiv">水果留言板</div>
		<div id="tabsF">
			<ul>
			<?php
			if(!isset($_GET["pid"]))
			{
			?>
				<li id="current"><a href="javascript://" onclick="loadTab(this,1);"><span>中葉(蜜棗)</span></a></li>
				<li><a href="javascript://" onclick="loadTab(this,2);"><span>金桃(蜜棗)</span></a></li>
				<li><a href="javascript://" onclick="loadTab(this,3);"><span>蓮霧</span></a></li>
			<?php
			}
			elseif($_GET["pid"]=="1")
			{
			?>
				<li id="current"><a href="javascript://" onclick="loadTab(this,1);"><span>中葉(蜜棗)</span></a></li>
				<li><a href="javascript://" onclick="loadTab(this,2);"><span>金桃(蜜棗)</span></a></li>
				<li><a href="javascript://" onclick="loadTab(this,3);"><span>蓮霧</span></a></li>
			<?php
			}
			elseif($_GET["pid"]=="2")
			{
			?>
				<li><a href="javascript://" onclick="loadTab(this,1);"><span>中葉(蜜棗)</span></a></li>
				<li id="current"><a href="javascript://" onclick="loadTab(this,2);"><span>金桃(蜜棗)</span></a></li>
				<li><a href="javascript://" onclick="loadTab(this,3);"><span>蓮霧</span></a></li>
			<?php
			}
			elseif($_GET["pid"]=="3")
			{
			?>
				<li><a href="javascript://" onclick="loadTab(this,1);"><span>中葉(蜜棗)</span></a></li>
				<li><a href="javascript://" onclick="loadTab(this,2);"><span>金桃(蜜棗)</span></a></li>
				<li id="current"><a href="javascript://" onclick="loadTab(this,3);"><span>蓮霧</span></a></li>
			<?php
			}
			?>
			</ul>
		</div>
		<div id="tabsC">
			<div id="S1" style="display:<?php if(!isset($_GET["pid"])){ echo "inline"; }else{if($_GET["pid"]==1){ echo "inline"; }else{ echo "none";}}?>; float: center;">
				<?php
				while($row_RecScore1=mysql_fetch_assoc($RecProduct1))
				{?>
					<div class="albumDiv" style="height: 170px; margin: 8px; width: 98%;">
						<div style="margin: 0 1% 0 1%;">
							<div style="float:left; width: 30%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">暱稱：</a><?php echo $row_RecScore1["nickname"];?>
							</div>
							<div style="float:left; width: 30%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">水果：</a><?php echo "中葉";?>
							</div>
							<div style="float:left; width: 40%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">分數：</a><?php echo $row_RecScore1["star"];?>
							</div>
						</div>
						<br>
						<div style="float:left; width: 98%; height: 100px; margin: 0 1% 0 1%; border-bottom: 2px solid #008f00;" align="left">
							<a class="titleDiv">評論內容：</a><?php echo $row_RecScore1["comment"];?>
						</div>
						<br>
						<div style="float:right; margin: 0 1% 0 1%;">
							<a class="titleDiv">發表日期：</a><?php echo $row_RecScore1["date"];?>
						</div>
					</div>
				<?php
				}
				?>
				<div class="navDiv">
					<?php if ($num_pages > 1)
					{ // 若不是第一頁則顯示 ?>
						<a href="?page=1<?php echo keepURL();?>">|&lt;</a>
						<a href="?page=<?php echo $num_pages-1;?><?php echo keepURL();?>">&lt;&lt;</a>
					<?php 
					}else
					{?>
						|&lt; &lt;&lt;
					<?php
					}?>
					<?php
					for($i=1;$i<=$total_pages1;$i++)
					{
						if($i==$num_pages)
						{
							echo $i." ";
						}
						else
						{
							$urlstr = keepURL();
							echo "<a href=\"?page=$i$urlstr\">$i</a> ";
						}
					}
					if ($num_pages < $total_pages1)
					{ // 若不是最後一頁則顯示 ?>
						<a href="?page=<?php echo $num_pages+1;?><?php echo keepURL();?>">&gt;&gt;</a>
						<a href="?page=<?php echo $total_pages1;?><?php echo keepURL();?>">&gt;|</a>
					<?php
					}else
					{?>
						&gt;&gt; &gt;|
					<?php
					}?>
				</div>
			</div>
			<div id="S2" style="display:<?php if(isset($GET["pid"])){if($_GET["pid"]==2){ echo "inline"; }}else{ echo"none";}?>; float: center;">
				<?php
				while($row_RecScore2=mysql_fetch_assoc($RecProduct2))
				{?>
					<div class="albumDiv" style="height: 170px;margin: 8px; width: 98%;">
						<div style="margin: 0 1% 0 1%;">
							<div style="float:left; width: 30%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">暱稱：</a><?php echo $row_RecScore2["nickname"];?>
							</div>
							<div style="float:left; width: 30%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">水果：</a><?php echo "金桃";?>
							</div>
							<div style="float:left; width: 40%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">分數：</a><?php echo $row_RecScore2["star"];?>
							</div>
						</div>
						<br>
						<div style="float:left; width: 98%; height: 100px; margin: 0 1% 0 1%; border-bottom: 2px solid #008f00;" align="left">
							<a class="titleDiv">評論內容：</a><?php echo $row_RecScore2["comment"];?>
						</div>
						<br>
						<div style="float:right; margin: 0 1% 0 1%;">
							<a class="titleDiv">發表日期：</a><?php echo $row_RecScore2["date"];?>
						</div>
					</div>
				<?php
				}
				?>
				<div class="navDiv">
					<?php if ($num_pages > 1)
					{ // 若不是第一頁則顯示 ?>
						<a href="?page=1<?php echo keepURL();?>">|&lt;</a>
						<a href="?page=<?php echo $num_pages-1;?><?php echo keepURL();?>">&lt;&lt;</a>
					<?php 
					}else
					{?>
						|&lt; &lt;&lt;
					<?php
					}?>
					<?php
					for($i=1;$i<=$total_pages2;$i++)
					{
						if($i==$num_pages)
						{
							echo $i." ";
						}
						else
						{
							$urlstr = keepURL();
							echo "<a href=\"?page=$i$urlstr\">$i</a> ";
						}
					}
					if ($num_pages < $total_pages2)
					{ // 若不是最後一頁則顯示 ?>
						<a href="?page=<?php echo $num_pages+1;?><?php echo keepURL();?>">&gt;&gt;</a>
						<a href="?page=<?php echo $total_pages2;?><?php echo keepURL();?>">&gt;|</a>
					<?php
					}else
					{?>
						&gt;&gt; &gt;|
					<?php
					}?>
				</div>
			</div>
			<div id="S3" style="display:<?php if(isset($GET["pid"])){if($_GET["pid"]==3){ echo "inline"; }}else{ echo"none";}?>;">
				<?php
				while($row_RecScore3=mysql_fetch_assoc($RecProduct3))
				{?>
					<div class="albumDiv" style="height: 170px;margin: 8px; width: 98%;">
						<div style="margin: 0 1% 0 1%;">
							<div style="float:left; width: 30%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">暱稱：</a><?php echo $row_RecScore3["nickname"];?>
							</div>
							<div style="float:left; width: 30%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">水果：</a><?php echo "蓮霧";?>
							</div>
							<div style="float:left; width: 40%; border-bottom: 2px solid #008f00;" align="left">
								<a class="titleDiv">分數：</a><?php echo $row_RecScore3["star"];?>
							</div>
						</div>
						<br>
						<div style="float:left; width: 98%; height: 100px; margin: 0 1% 0 1%; border-bottom: 2px solid #008f00;" align="left">
							<a class="titleDiv">評論內容：</a><?php echo $row_RecScore3["comment"];?>
						</div>
						<br>
						<div style="float:right; margin: 0 1% 0 1%;">
							<a class="titleDiv">發表日期：</a><?php echo $row_RecScore3["date"];?>
						</div>
					</div>
				<?php
				}
				?>
				<div class="navDiv">
					<?php if ($num_pages > 1)
					{ // 若不是第一頁則顯示 ?>
						<a href="?page=1<?php echo keepURL();?>">|&lt;</a>
						<a href="?page=<?php echo $num_pages-1;?><?php echo keepURL();?>">&lt;&lt;</a>
					<?php 
					}else
					{?>
						|&lt; &lt;&lt;
					<?php
					}?>
					<?php
					for($i=1;$i<=$total_pages3;$i++)
					{
						if($i==$num_pages)
						{
							echo $i." ";
						}
						else
						{
							$urlstr = keepURL();
							echo "<a href=\"?page=$i$urlstr\">$i</a> ";
						}
					}
					if ($num_pages < $total_pages3)
					{ // 若不是最後一頁則顯示 ?>
						<a href="?page=<?php echo $num_pages+1;?><?php echo keepURL();?>">&gt;&gt;</a>
						<a href="?page=<?php echo $total_pages3;?><?php echo keepURL();?>">&gt;|</a>
					<?php
					}else
					{?>
						&gt;&gt; &gt;|
					<?php
					}?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
