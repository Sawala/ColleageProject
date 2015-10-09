<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(!isset($_SESSION))
{
    session_start();
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
if(isset($_GET["cid"])&&($_GET["cid"]!="")){
	$query_RecProduct = "SELECT * FROM `product` WHERE `categoryid`=".$_GET["cid"]." ORDER BY `productid` DESC";
//若有搜尋關鍵字時未加限制顯示筆數的SQL敘述句
}elseif(isset($_GET["keyword"])&&($_GET["keyword"]!="")){
	$query_RecProduct = "SELECT * FROM `product` WHERE `productname` LIKE '%".$_GET["keyword"]."%' OR `description` LIKE '%".$_GET["keyword"]."%' ORDER BY `productid` DESC";
//若有價格區間關鍵字時未加限制顯示筆數的SQL敘述句
}elseif(isset($_GET["price1"]) && isset($_GET["price2"]) && ($_GET["price1"]<=$_GET["price2"])){
	$query_RecProduct = "SELECT * FROM `product` WHERE `productprice` BETWEEN ".$_GET["price1"]." AND ".$_GET["price2"]." ORDER BY `productid` DESC";
//預設狀況下未加限制顯示筆數的SQL敘述句
}else{
	$query_RecProduct = "SELECT * FROM `product` ORDER BY `productid` DESC";
}
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$query_limit_RecProduct = $query_RecProduct." LIMIT ".$startRow_records.", ".$pageRow_records;
//以加上限制顯示筆數的SQL敘述句查詢資料到 $RecProduct 中
$RecProduct = mysql_query($query_limit_RecProduct);
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_RecProduct 中
$all_RecProduct = mysql_query($query_RecProduct);
//計算總筆數
$total_records = mysql_num_rows($all_RecProduct);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records);
//繫結產品目錄資料
$query_RecCategory = "SELECT `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort`, count(`product`.`productid`) as productNum FROM `category` LEFT JOIN `product` ON `category`.`categoryid` = `product`.`categoryid` GROUP BY `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort` ORDER BY `category`.`categorysort` ASC";
$RecCategory = mysql_query($query_RecCategory);
//計算資料總筆數
$query_RecTotal = "SELECT count(`productid`)as totalNum FROM `product`";
$RecTotal = mysql_query($query_RecTotal);
$row_RecTotal=mysql_fetch_assoc($RecTotal);
//返回 URL 參數
function keepURL(){
	$keepURL = "";
	if(isset($_GET["keyword"])) $keepURL.="&keyword=".urlencode($_GET["keyword"]);
	if(isset($_GET["price1"])) $keepURL.="&price1=".$_GET["price1"];
	if(isset($_GET["price2"])) $keepURL.="&price2=".$_GET["price2"];	
	if(isset($_GET["cid"])) $keepURL.="&cid=".$_GET["cid"];
	return $keepURL;
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
	$averagestarli1 = $item*24;
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
	$averagestarli2 = $item*24;
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
	$averagestarli3 = $item*24;
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
    <div class="AdDiv">
    果農張先生說：「燕巢的蜜棗是由鹽埔這裡所傳出去，燕巢蜜棗承襲鹽埔的優點而如此香甜，所以鹽埔的蜜棗肯定比燕巢的更加美味。」
    </div><br>
    <?php	while($row_RecProduct=mysql_fetch_assoc($RecProduct)){ ?>
    <div class="albumDiv">
      <div class="picDiv"><a href="product.php?id=<?php echo $row_RecProduct["productid"];?>">
        <?php if($row_RecProduct["productimages"]==""){?>
        <img src="images/nopic.png" alt="暫無圖片" width="100" height="100" border="0"/>
        <?php }else{?>
        <img src="proimg/<?php echo $row_RecProduct["productimages"];?>" alt="<?php echo $row_RecProduct["productname"];?>" width="100" height="100" border="0" />
        <?php }?>
      </a>
	  </div>
      <div id="ProContent">  
      <div class="titleDiv">  <?php 
	  echo $row_RecProduct["productname"];?>
    
      </div>
	  <div style="float: left; font-size: 16px; font-weight: bold; color: #0066CC;">
		買家評分：
	  </div>
	  <div style="float: left;">
		<ul class='star-rating-showproduct'>
		<?php if($row_RecProduct["productid"]==1)
			{
		?>
			<li class='average-rating-showproduct' style="width: <?php echo $averagestarli1; ?>px;"></li>
		<?php
			}
			elseif($row_RecProduct["productid"]==2)
			{
		?>
			<li class='average-rating-showproduct' style="width: <?php echo $averagestarli2; ?>px;"></li>
		<?php
			}
			else
			{
		?>
			<li class='average-rating-showproduct' style="width: <?php echo $averagestarli3; ?>px;"></li>
		<?php
			}
		?>
		</ul>
		</div>
		<a style="float: left; font-size: 14px; color: #F00;" href="messageboard.php?pid=<?php
			if($row_RecProduct["productid"]==1) echo "1";
			if($row_RecProduct["productid"]==2) echo "2";
			if($row_RecProduct["productid"]==3) echo "3";
		?> ">
			　(共有
				<?php 
				if($row_RecProduct["productid"]==1) echo $ScoreCount1;
				if($row_RecProduct["productid"]==2) echo $ScoreCount2;
				if($row_RecProduct["productid"]==3) echo $ScoreCount3;
				?>
			則評論)
		</a>
	  <div id="Buy"  align="right">
	<a href="product.php?id=<?php echo $row_RecProduct["productid"];?>">
<img src="images/購買.jpg"/>
</a>
</div>
      <div align="left">
	  <?php
	  echo "　　".$row_RecProduct["description"];?>
      </div>
      </div>
    </div>
    <?php }?>
	<div class="navDiv">
              <?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
              <a href="?page=1<?php echo keepURL();?>">|&lt;</a> <a href="?page=<?php echo $num_pages-1;?><?php echo keepURL();?>">&lt;&lt;</a>
              <?php }else{?>
              |&lt; &lt;&lt;
              <?php }?>
              <?php
  	  for($i=1;$i<=$total_pages;$i++){
  	  	  if($i==$num_pages){
  	  	  	  echo $i." ";
  	  	  }else{
  	  	      $urlstr = keepURL();
  	  	      echo "<a href=\"?page=$i$urlstr\">$i</a> ";
  	  	  }
  	  }
  	  ?>
              <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
              <a href="?page=<?php echo $num_pages+1;?><?php echo keepURL();?>">&gt;&gt;</a> <a href="?page=<?php echo $total_pages;?><?php echo keepURL();?>">&gt;|</a>
              <?php }else{?>
              &gt;&gt; &gt;|
              <?php }?>
            </div>
			</div>
  </div>
  <div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
