<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
//購物車開始
include("mycart.php");
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
//拿最新消息內容
$query_RecNews = "SELECT * FROM `news` ORDER BY `newstime` DESC";
$RecNews = mysql_query($query_RecNews);
if(isset($_SESSION["loginMember"]))
{
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);	
	$row_RecMember=mysql_fetch_assoc($RecMember);
}

if(isset($_SESSION["loginMember"]))
{
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);	
	$row_RecMember=mysql_fetch_assoc($RecMember);
}

$cart =& $_SESSION['cart']; // 將購物車的值設定為 Session
if(!is_object($cart)) $cart = new myCart();
//購物車結束
//繫結產品目錄資料
$query_RecCategory = "SELECT `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort`, count(`product`.`productid`) as productNum FROM `category` LEFT JOIN `product` ON `category`.`categoryid` = `product`.`categoryid` GROUP BY `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort` ORDER BY `category`.`categorysort` ASC";
$RecCategory = mysql_query($query_RecCategory);
//計算資料總筆數
$query_RecTotal = "SELECT count(`productid`)as totalNum FROM `product`";
$RecTotal = mysql_query($query_RecTotal);
$row_RecTotal=mysql_fetch_assoc($RecTotal);
//檢查是否登入，如果沒有的話會導入到會員介面
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
?>
<script language="javascript">
	alert('您尚未登入會員。\n請先登入會員，再進行結帳動作。');
	window.location.href='member_index.php';		  
</script>
<?php
}

//求中葉總筆數
$query_RecOrderDetail1 = "SELECT SUM(`quantity`) FROM `orderdetail` WHERE `productid`=1 ";
$RecOrderDetail1 = mysql_query($query_RecOrderDetail1);
$row_OrderDetail1 = mysql_fetch_assoc($RecOrderDetail1);
foreach($row_OrderDetail1 as $item)
{
	$row_OrderDetail1 = $item;
}
//求金桃總筆數
$query_RecOrderDetail2 = "SELECT SUM(`quantity`) FROM `orderdetail` WHERE `productid`=2 ";
$RecOrderDetail2 = mysql_query($query_RecOrderDetail2);
$row_OrderDetail2 = mysql_fetch_assoc($RecOrderDetail2);
foreach($row_OrderDetail2 as $item)
{
	$row_OrderDetail2 = $item;
}
//求蓮霧總筆數
$query_RecOrderDetail3 = "SELECT SUM(`quantity`) FROM `orderdetail` WHERE `productid`=3 ";
$RecOrderDetail3 = mysql_query($query_RecOrderDetail3);
$row_OrderDetail3 = mysql_fetch_assoc($RecOrderDetail3);
foreach($row_OrderDetail3 as $item)
{
	$row_OrderDetail3 = $item;
}
//檢測
foreach($cart->get_contents() as $item)
{
	if($item['id']==1)
	{
		//繫結中葉資料
		$query_RecProduct1 = "SELECT * FROM `product` WHERE `productid` = 1";
		$RecProduct1 = mysql_query($query_RecProduct1);
		$row_RecProduct1 = mysql_fetch_assoc($RecProduct1);
		
		$stillhave = $row_RecProduct1["total"] - $row_OrderDetail1;
		if($stillhave < $item['qty'])
		{
		?>
			<script language="javascript">
				alert("您購買的數量已超過中葉(蜜棗)的剩餘產量，\n請重新修改數量。");
				window.location.href="cart.php";
			</script>
		<?php
		}
	}
	elseif($item['id']==2)
	{
		//繫結中葉資料
		$query_RecProduct2 = "SELECT * FROM `product` WHERE `productid` = 2";
		$RecProduct2 = mysql_query($query_RecProduct2);
		$row_RecProduct2 = mysql_fetch_assoc($RecProduct2);
		
		$stillhave = $row_RecProduct2["total"] - $row_OrderDetail2;
		if($stillhave < $item['qty'])
		{
		?>
			<script language="javascript">
				alert("您購買的數量已超過金桃(蜜棗)的剩餘產量，\n請重新修改數量。");
				window.location.href="cart.php";
			</script>
		<?php
		}
	}
	elseif($item['id']==3)
	{
		//繫結中葉資料
		$query_RecProduct3 = "SELECT * FROM `product` WHERE `productid` = 3";
		$RecProduct3 = mysql_query($query_RecProduct3);
		$row_RecProduct3 = mysql_fetch_assoc($RecProduct3);
		
		$stillhave = $row_RecProduct3["total"] - $row_OrderDetail3;
		if($stillhave < $item['qty'])
		{
		?>
			<script language="javascript">
				alert("您購買的數量已超過蓮霧的剩餘產量，\n請重新修改數量。");
				window.location.href="cart.php";
			</script>
		<?php
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css">

<?php
// Request selected language
$hl = (isset($_POST["hl"])) ? $_POST["hl"] : false;
if(!defined("L_LANG") || L_LANG == "L_LANG")
{
	if($hl) define("L_LANG", $hl);

	// You need to tell the class which language you want to use.
	// L_LANG should be defined as en_US format!!! Next line is an example, just put your own language from the provided list
	else define("L_LANG", "zh_TW"); // Ebraic example - change the red value to your desired language (from the list provided)
}
?>
<script language="javascript">
function checkForm(){	
	if(document.cartform.customername.value==""){
		alert("請填寫姓名!");
		document.cartform.customername.focus();
		return false;
	}
	if(document.cartform.customeremail.value==""){
		alert("請填寫電子郵件!");
		document.cartform.customeremail.focus();
		return false;
	}
	if(!checkmail(document.cartform.customeremail)){
		document.cartform.customeremail.focus();
		return false;
	}	
	if(document.cartform.customerphone.value==""){
		alert("請填寫電話!");
		document.cartform.customerphone.focus();
		return false;
	}
	if(document.cartform.customeraddress.value==""){
		alert("請填寫地址!");
		document.cartform.customeraddress.focus();
		return false;
	}
	if(document.cartform.date1.value=="0000-00-00"){
		alert("您尚未填寫取貨時間！");
		document.cartform.date1.focus();
		return false;
	}
	return confirm('在傳送資料的過程中，請勿傳送相同的訂單資料！\n確定要送出嗎？');
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
<script type="text/javascript" src="./css/jquery-2.0.3.js"></script>
<script>
var Submit=function(){
if(checkForm())
{
            var URLs="cartreport.php";
           
            $.ajax({
                url: URLs,
                data: $('#cartform').serialize(),
                type:"POST",
                dataType:'text',
                success: function(){
                    alert("感謝您的購買，我們將儘快進行處理。\n\t按下確認鍵將返回購物首頁");
					window.location.href="index.php";
                },
                beforeSend:function(){
                    $('#loadingIMG').show();
					$('#order').hide();
                },
                complete:function(){
                    $('#loadingIMG').hide();
                },
                error:function(xhr, ajaxOptions, thrownError){
                    alert("郵寄失敗！\n在傳輸訂單的過程中出現錯誤，請確認您的網路是否正常，\n並請您確認email中是否收到訂單通知，\n依照是否收到通知為訂單依據，\n若您收到email，請您不要再傳送相同訂單！\n按下確認鍵將返回購物首頁。");
					window.location.href="index.php";
                }
            });
        }
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
	<div id="loadingIMG" style="display: none; float:center; margin: 250px 0 0 0px;"><img src="./images/loading.gif" height='100'/><p style="font-size:24px; font-family:微軟正黑體; font-weight:bold; color:#0062ff;">您的購物資料處理中，請稍後。</p></div>
	<div id="order">
          <br><div class="subjectDiv">購物結帳</div>
              <?php if($cart->itemcount > 0) {?>
              <p class="heading">購物內容</p>
			  <p style="float: center; font-size: 16px; color: #F00; line-height: 160%;">請務必仔細確認您所訂購的商品與數量是否正確，如需更改內容請點選 "<strong>回上一頁</strong>" 謝謝。</p>
              <table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
                <tr>
                  <th bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">編號</p></th>
                  <th bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">產品名稱</p></th>
                  <th bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">數量</p></th>
                  <th bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">單價</p></th>
                  <th bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">小計</p></th>
                </tr>
                <?php		  
		  	$i=0;
			$tempcount = 0;//計算總盒數
			$temptotal = 0;
			$temptotalf = 0;
			foreach($cart->get_contents() as $item) {
			$i++;
		  ?>
                <tr>
					<td align="center" bgcolor="#ffffb3" class="tdbline"><p style="font-size:16px; font-family:微軟正黑體;"><?php echo $i;?>.</p></td>
					<td align="center" bgcolor="#ffffb3" class="tdbline"><p style="font-size:16px; font-family:微軟正黑體;"><?php echo $item['info'];?></p></td>
					<td align="center" bgcolor="#ffffb3" class="tdbline"><p style="font-size:16px; font-family:微軟正黑體;"><?php echo $item['qty'];?></p></td>
					<td align="center" bgcolor="#ffffb3" class="tdbline"><p style="font-size:16px; font-family:微軟正黑體;">$ <?php echo number_format($item['price']);?></p></td>
					<td align="center" bgcolor="#ffffb3" class="tdbline"><p style="font-size:16px; font-family:微軟正黑體;">$ <?php echo number_format($item['subtotal']);?></p></td>
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
						<td align="center" valign="baseline" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">運費</p></td>
						<td valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
						<td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
						<td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
						<td align="center" valign="baseline" bgcolor="#ffffb3"><p>$ <?php echo number_format($cart->deliverfee);?></p></td>
					</tr>
					<tr>
						<td align="center" valign="baseline" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">總計</p></td>
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
                  <td align="center" valign="baseline" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">總計</p></td>
                  <td valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
                  <td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
                  <td align="center" valign="baseline" bgcolor="#ffffb3"><p>&nbsp;</p></td>
                  <td align="center" valign="baseline" bgcolor="#ffffb3"><p class="redword">$ <?php echo $temptotal;?></p></td>
                </tr>
				<?php
				}
				?>
              </table>
              <p class="heading">收件人資訊</p>	 
			  <p style="float: center; font-size: 16px; color: #F00; line-height: 160%;">請填寫欲將商品運送到達地點之資料。<br>您的資料確認無誤後請點選 "<strong>送出訂購單</strong>" 按鈕，謝謝。</p>
              <form name="cartform" id="cartform">
                <table width="90%" border="0" align="center" cellpadding="2" cellspacing="1">
                  <tr>
                    <th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">會員姓名</p></th>
                    <td colspan="3" bgcolor="#ffffb3"><p>
                        <input type="text" name="customername" id="customername" value="<?php echo $row_RecMember["m_name"];?>">
                        <font color="#FF0000">*</font>表示為必填的欄位</p></td>
                  </tr>
                  <tr>
                    <th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">電子郵件</p></th>
                    <td colspan="3" bgcolor="#ffffb3"><p>
                        <input type="text" name="customeremail" id="customeremail" value="<?php echo $row_RecMember["m_email"];?>">
                        <font color="#FF0000">*</font></p></td>
                  </tr>
					<tr>
					<th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">收件人姓名</p></th>
						<td colspan="1" align="left" bgcolor="#ffffb3">
							<input type="text" name="recipient" id="recipient" value="">
							<font color="#FF0000">*</font> 
						</td>
                    <th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">收件人電話</p></th>
                    <td colspan="3" bgcolor="#ffffb3"><p>
                        <input type="text" name="customerphone" id="customerphone" value="<?php echo $row_RecMember["m_phone"];?>">
                        <font color="#FF0000">*</font></p>
					</td>
                  </tr>
                  <tr>
                    <th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">收件地址</p></th>
                    <td colspan="3" bgcolor="#ffffb3"><p>
                        <input name="customeraddress" type="text" id="customeraddress" size="40" value="<?php echo $row_RecMember["m_address"];?>">
                        <font color="#FF0000">*</font></p></td>
                  </tr>
				  <tr>
                    <th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">到貨日期</p></th>
                    <td colspan="3" width="28%" bgcolor="#ffffb3">
                        <?php
						//get class into the page
						require_once('calendar/tc_calendar.php');
						//instantiate class and set properties
						$myCalendar = new tc_calendar("date1", true, false);
						$myCalendar->setIcon("calendar/images/iconCalendar.gif");
						$myCalendar->setYearInterval(2013, 2020);
						$myCalendar->dateAllow(date("Y-m-d",mktime(0,0,0,date("m"),date("d")+6,date("Y"))), '2014-02-15');
						$myCalendar->setAutoHide(true, 3000); 
						$myCalendar->setOnChange("myChanged('test')");
						$myCalendar->writeScript();
						//output the calendar 
						?>	
							<script language="javascript">
							function myChanged(){
								alert("您好，日期已更改為: "+document.getElementById("date1").value+"["+v+"]");
							}
							</script>
							
                        <font color="#FF0000">*</font>
						
						<span style="text-align:right; color:#0000FF;"><br>您可以指定於隔日開始算的第6天(含)之後為到貨日期</span>
						
					</td>
				</tr>
				
				<tr>
					<th width="20%" bgcolor="#ffe100">
						<p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">
						取貨時間
						</p>
					</th>
					<td colspan="1" width="28%" bgcolor="#ffffb3">
						<input type="radio" name="pickuptime" value="1" checked>早上
						<input type="radio" name="pickuptime" value="2">下午
						<input type="radio" name="pickuptime" value="3">晚上
					</td>
				
				
                    <th width="20%" bgcolor="#ffe100"><p style="font-size:18px; font-family:微軟正黑體; font-weight:bold; color:#008002;">付款方式</p></th>
                    <td colspan="1" align="left" bgcolor="#ffffb3">
						<p>
							<select name="paytype" id="paytype">
								<option value="ATM轉帳" selected>ATM轉帳</option>
								<option value="貨到付款">貨到付款</option>
							</select>
							<font color="#FF0000">*</font> 
						</p>
					</td>
				</tr>
				<tr>
                    <td colspan="6" align="center" bgcolor="#ffffb3">
						<span style=" color:#FF0000;"><span style="color:#000;">如果您選擇<strong>ATM轉帳</strong>，</span>請您在當日訂購開始算的第三天下午11:59前轉入款項。<span style="color:#000;"><br>請參閱<a href="paydelivery.php" target="_blank">付款說明</a>與<a href="delivery.php" target="_blank">商品運送</a>。</span><br>
						<input name="cartaction" type="hidden" id="cartaction" value="update">
						<input type="button" class="button11" name="updatebtn" id="button3" value="送出訂購單" onclick="Submit()">
						<input type="button" class="button11" name="backbtn" id="button4" value="回上一頁" onClick="window.history.back();">
					</td>
                </tr>
            </table>
              </form>
            <?php }else{ ?>
            <div class="infoDiv">目前購物車是空的。</div>
            <?php } ?>
	</div>
	</div>
    </div>
	<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
