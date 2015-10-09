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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
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
			　|　<a href="">登出</a>
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
    <br><div class="subjectDiv">鴕鳥簡介</div>
    <p align="left" style="font-size: 13pt; margin-left:30px; margin-right:30px; line-height: 180%;">
    鴕鳥原為野生動物之一種，在動物分類學上屬於鳥綱(Aves)，新鳥亞綱(Neornithes)，鴕形目(Struthioniformes)，鴕鳥科(Struthionidae)，鴕鳥屬(Stru- thio)，鴕鳥種(Struthio camelus)。鴕鳥原是南非共和國列為國寶級與管制出口的動物，美、澳於二十多年前，曾利用特殊管道進口鴕鳥蛋，經飼養繁殖育種成功，於十幾年前開始大量高價推廣鴕鳥肉及鴕鳥皮產品，而迫使南非不得不向全世界宣布開放活體鴕鳥出口，一時引起全世界飼養鴕鳥熱潮。台灣近年來也陸續發展鴕鳥養殖，行政院農業委員會並於2004年3月24日公告(農牧字第0930040237號公告)，指定人工飼養鴕鳥為家禽。
    </p>
    <div class="titleDiv">品種</div>
    <p align="left" style="font-size: 13pt; margin-left:30px; margin-right:30px; line-height: 180%;">
    鴕鳥主要分為三大類(紅頸鴕鳥、藍頸鴕鳥與合成品種)。紅頸鴕鳥(Red neck)包括 (1) 北非鴕鳥：體高較高，頸和腿較長，腿粗壯，頭冠上有一禿斑，其周圍生長一圈棕色羽毛，未成年雄鳥與雌鳥皮膚呈淡黃色，成年雄鳥軀體通常為紅至粉紅色，在繁殖季節，雄鳥的頭部、頸部和腿部的紅色色彩更加明顯。(2) 東非鴕鳥：亦稱為馬塞鴕鳥，頭冠呈部份禿或無禿，雄鳥頸部和大腿為粉紅色，在繁殖季節色彩更加明顯。藍頸鴕鳥(Blue neck)包括(1)南非鴕鳥：頭冠上長有羽毛，頸部為灰色，繁殖季節轉為紅色，雄鳥的腳部鱗片亦呈鮮紅色，無白色頸環。(2) 索馬利鴕鳥：頭冠與北非鴕鳥養的很少，目前主要人工飼養的鴕鳥品種是一種合成品種，統稱為非洲黑鴕鳥(African Black)，是由東非鴕鳥，南非鴕鳥與北鴕鳥雜交而成，每隻高約2公尺，重約120～150 公斤， 2～3歲齡達性成熟，安靜且具有高品質的羽毛。
    </p>
    
    </div>
</div>
<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>