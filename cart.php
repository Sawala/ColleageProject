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
// 更新購物車內容
if(isset($_POST["cartaction"]) && ($_POST["cartaction"]=="update")){
	if(isset($_POST["updateid"])){
		$i=count($_POST["updateid"]);
		for($j=0;$j<$i;$j++){
			$cart->edit_item($_POST['updateid'][$j],$_POST['qty'][$j]);
		}
	}
	header("Location: cart.php");
}
// 移除購物車內容
if(isset($_GET["cartaction"]) && ($_GET["cartaction"]=="remove")){
	$rid = intval($_GET['delid']);
	$cart->del_item($rid);
	header("Location: cart.php");	
}
// 清空購物車內容
if(isset($_GET["cartaction"]) && ($_GET["cartaction"]=="empty")){
	$cart->empty_cart();
	header("Location: cart.php");
}
//購物車結束
//繫結產品目錄資料
$query_RecCategory = "SELECT `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort`, count(`product`.`productid`) as productNum FROM `category` LEFT JOIN `product` ON `category`.`categoryid` = `product`.`categoryid` GROUP BY `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort` ORDER BY `category`.`categorysort` ASC";
$RecCategory = mysql_query($query_RecCategory);
//計算資料總筆數

$query_RecTotal = "SELECT count(`productid`)as totalNum FROM `product`";
$RecTotal = mysql_query($query_RecTotal);
$row_RecTotal=mysql_fetch_assoc($RecTotal);
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
		<br><div class="subjectDiv">購物車內容</div>
		<p class="heading"></p>
		  <?php if($cart->itemcount > 0) {?>
          <form action="" method="post" name="cartform" id="cartform">
          <table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
              <tr>
                <th bgcolor="#ffe100"><p>&nbsp;</p></th>
                <th bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; color:#008002;">產 品 名 稱</p></th>
                <th bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; color:#008002;">數 量</p></th>
                <th bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; color:#008002;">單 價</p></th>
                <th bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; color:#008002;">小 計</p></th>
              </tr>
          <?php
			$tempcount = 0;//計算總盒數
			$temptotal = 0;
			$temptotalf = 0;
		  	foreach($cart->get_contents() as $item) {
		  ?>              
              <tr>
                <td align="center" bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; color:#008002;"><a href="?cartaction=remove&delid=<?php echo $item['id'];?>">移除</a></p></td>
                <td align="center" bgcolor="#ffffb3"><p style="font-size:16px; font-family:微軟正黑體;"><?php echo $item['info'];?></p></td>
                <td align="center" bgcolor="#ffffb3"><p>
                  <input name="updateid[]" type="hidden" id="updateid[]" value="<?php echo $item['id'];?>">
                  <input name="qty[]" type="text" id="qty[]" onchange="document.cartform.submit();" value="<?php echo $item['qty'];?>" size="7">
                  </p></td>
                <td align="center" bgcolor="#ffffb3"><p style="font-size:16px; font-family:微軟正黑體;">$ <?php echo number_format($item['price']);?></p></td>
                <td align="center" bgcolor="#ffffb3"><p style="font-size:16px; font-family:微軟正黑體;">$ <?php echo number_format($item['subtotal']);?></p></td>
              </tr>
			<?php
				$tempcount += $item['qty'];
				$temptotalf += $item['subtotal'];
				$temptotal = number_format($temptotalf);//計算沒有運費的總金額
			}
			if($tempcount == 1)//如果購買盒數=1，顯示運費
			{
			?>
				<tr>
					<td align="center" valign="baseline" bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; font-weight:bold; color:#008002;">運費</p></td>
					<td valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
					<td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
					<td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
					<td align="center" valign="baseline" bgcolor="#ffffb3"><p style="font-size:16px; font-family:微軟正黑體;">$ <?php echo number_format($cart->deliverfee);?></p></td>
				</tr>
				<tr>
					<td align="center" valign="baseline" bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; font-weight:bold; color:#008002;">總計</p></td>
					<td valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
					<td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
					<td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
					<td align="center" valign="baseline" bgcolor="#ffffb3"><p class="redword">$ <?php echo number_format($cart->grandtotal);?></p></td>
				</tr>
			<?php
			}
			else//盒數>=2，扣除運費
			{
			?>
            <tr>
                <td align="center" valign="baseline" bgcolor="#ffe100"><p style="font-size:20px; font-family:微軟正黑體; font-weight:bold; color:#008002;">總計</p></td>
                <td valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
                <td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
                <td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
                <td align="center" valign="baseline" bgcolor="#ffffb3"><p class="redword">$ <?php echo $temptotal;?></p></td>
            </tr>
			<?php
			}
			?>
			</table>
			<p style="float: center; font-size: 16px; color: #F00;"><strong>購買單盒產品需自行給付額外運費。購買兩盒(含)產品以上，張家蜜棗會為您吸收運費喔！</strong></p>
			<p style="float: center; font-size: 15px;"><span style="color: #00F;">提醒您</span>：若有任何商品數量的更改，請務必點選<strong>網頁空白處或Enter鍵</strong>以確認您的商品更動唷！</p>
			<p style="float: center; font-size: 15px;">請參閱<a href="process.php" target="_blank">訂購須知</a>。</p>
            <hr width="90%" size="1" />
            <p align="center">
              <input name="cartaction" type="hidden" id="cartaction" value="update">
              <input type="button" class="button11" name="emptybtn" id="button5" value="清空購物車" onClick="window.location.href='?cartaction=empty'">
              <input type="button" class="button11" name="button" id="button6" value="前往結帳" onClick="window.location.href='shopping_agreement.php';">
              <input type="button" class="button11" name="backbtn" id="button4" value="回上一頁" onClick="window.history.back();">
              </p>
          </form>
            <?php }else{ ?>
            <div class="infoDiv">目前購物車是空的。</div>
			<p align="center">
              <input type="button" class="button11" name="backbtn" id="button4" value="回上一頁" onClick="window.history.back();">
              </p>
          <?php } ?>
	
	</div>
  </div>
  <div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
