<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
//購物車開始
require_once("mycart.php");
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

$cart =& $_SESSION['cart']; // 將購物車的值設定為 Session
if(!is_object($cart)) $cart = new myCart();
// 新增購物車內容
if(isset($_POST["cartaction"]) && ($_POST["cartaction"]=="add")){
$cart->add_item($_POST['id'],$_POST['qty'],$_POST['price'],$_POST['name']);
header("Location: cart.php");
}
//購物車結束
//繫結產品資料
$query_RecProduct = "SELECT * FROM `product` WHERE `productid`=".$_GET["id"];
$RecProduct = mysql_query($query_RecProduct);
$row_RecProduct=mysql_fetch_assoc($RecProduct);
//
$query_RecOrderDetail = "SELECT SUM(`quantity`) FROM `orderdetail` WHERE `productid`='".$_GET["id"]."'";
$RecOrderDetail = mysql_query($query_RecOrderDetail);
$row_OrderDetail = mysql_fetch_assoc($RecOrderDetail);
foreach($row_OrderDetail as $item)
{
	$row_OrderDetail = $item;
}

//繫結產品目錄資料
$query_RecCategory = "SELECT `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort`, count(`product`.`productid`) as productNum FROM `category` LEFT JOIN `product` ON `category`.`categoryid` = `product`.`categoryid` GROUP BY `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort` ORDER BY `category`.`categorysort` ASC";
$RecCategory = mysql_query($query_RecCategory);
//計算資料總筆數
$query_RecTotal = "SELECT count(`productid`) as totalNum FROM `product`";
$RecTotal = mysql_query($query_RecTotal);
$row_RecTotal=mysql_fetch_assoc($RecTotal);
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
		<div class="albumDiv">
            <div class="picDiv">
              <?php if($row_RecProduct["productimages"]==""){?>
              <img src="images/nopic.png" alt="暫無圖片" width="100" height="100" border="0" />
              <?php }else{?>
              <img src="proimg/<?php echo $row_RecProduct["productimages"];?>" alt="<?php echo $row_RecProduct["productname"];?>" width="100" height="100" border="0" />
              <?php }?>
            </div>
            
          
			<div class="titleDiv">
            <?php echo $row_RecProduct["productname"];
			?></div>
			<div class="dataDiv">
            <div class="techDiv"><?php echo nl2br($row_RecProduct["tech"]);?></div>
            <div class="brixDiv"><?php echo nl2br($row_RecProduct["brix"]);?></div>
            <div class="nutrientDiv"><?php echo nl2br($row_RecProduct["nutrient"]);?></div>
            <div class="albuminfo">
			<div style="float: center;">
				<ul class='star-rating'>
				<?php if($row_RecProduct["productid"]==1)
					{
				?>
					<li class='average-rating' style="width: <?php echo $averagestarli1; ?>px;"></li>
				<?php
					}
					elseif($row_RecProduct["productid"]==2)
					{
				?>
					<li class='average-rating' style="width: <?php echo $averagestarli2; ?>px;"></li>
				<?php
					}
					else
					{
				?>
					<li class='average-rating' style="width: <?php echo $averagestarli3; ?>px;"></li>
				<?php
					}
				?>
				</ul>
			</div>
			<span class="smalltext"><span style="color:#D7DF01;">每斤</span><span style="color:#013ADF; font-size:24px;">130</span><span style="color:#D7DF01;">元，每盒5斤 </span></span><span class="redword"><?php echo $row_RecProduct["productprice"];?></span> <span style="color:#D7DF01;">元，以每盒為訂購單位，謝謝。</span><br>
			<span class="smalltext">
			<?php
				if($row_OrderDetail >= $row_RecProduct["total"])
				{
					echo "(抱歉，已售完)";
				}
				else
				{
					$stillhave = $row_RecProduct["total"] - $row_OrderDetail;
					echo "(尚餘".$stillhave."份)";
				}
			?></span>
            <form name="form3" method="post" action="">
              <input name="id" type="hidden" id="id" value="<?php echo $row_RecProduct["productid"];?>">
              <input name="name" type="hidden" id="name" value="<?php echo $row_RecProduct["productname"];?>">
              <input name="price" type="hidden" id="price" value="<?php echo $row_RecProduct["productprice"];?>">
              <input name="qty" type="hidden" id="qty" value="1">
              <input name="cartaction" type="hidden" id="cartaction" value="add">
			  <?php
			  if($row_OrderDetail < $row_RecProduct["total"])
				{
				?>
			  <input type="submit" class="button11" name="button3" id="button3" value="加入購物車">
			  <?php
			  }
			  ?>
              <input type="button" class="button11" name="button4" id="button4" value="回上一頁" onClick="window.history.back();">
            </form>
            </div>
            </div>
          </div>
      </div>
	</div>
	<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>