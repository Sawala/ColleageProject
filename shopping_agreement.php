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
			<li><a href="paydelivery.php">商品運送</a></li>
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
	</div>
	<div id="EachContent">
		<br><div class="subjectDiv">「尋棗鹽埔/張家蜜棗」<br>線上購物服務使用條款</div><br>

	<div class="boxed" style="overflow-y:auto">


<p align="left" style="font-size: 12pt; line-height: 160%;">歡迎您在「尋棗鹽埔/張家蜜棗」進行消費；請您先詳細閱讀以下約定條款：
本約定條款的目的，是為了保護「尋棗鹽埔/張家蜜棗」以及您的權益，如果您點選「我同意」或類似語意的選項、或在「尋棗鹽埔/張家蜜棗」進行訂購、付款、消費或進行相關行為，就視為您事先已知悉、並同意本約定條款的所有約定。
</p>

<p align="left" style="font-size: 12pt;">壹、使用者</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、如果您要在「尋棗鹽埔/張家蜜棗」進行消費，您必須首次訂購流程中先填入您所合法取得且仍有效使用之電子郵件信箱並自行設定一組密碼；當您第一次在本網站留存相關資料或完成消費，本系統將紀錄您所填入之電子郵件信箱及您所自行設定之密碼，您並同意日後應以該組電子郵件信箱及密碼登錄後於「尋棗鹽埔/張家蜜棗」進行消費。<br>
二、您有自行妥善保管您留存於本網站系統之電子郵件帳號及所自行設定密碼之義務，不得將該電子郵件帳號及密碼透露或提供給第三人知悉、或出借或轉讓第三人使用。對於所有使用該組電子郵件帳號及密碼登入本服務系統所為之一切行為，都視為您本人之行為，並應由帳號持有人負其責任。</p>

<p align="left" style="font-size: 12pt;">貳、個人資料安全</p> 

<p align="left" style="font-size: 12pt; line-height: 160%;">一、為了完成交易，包括且不限於完成付款及交付等，您必須擔保在訂購過程中所留存的所有資料均為完整、正確、與當時情況相符的資料，如果事後有變更，您應該即時通知「尋棗鹽埔/張家蜜棗」。<br>
二、對於您所留存的資料，「尋棗鹽埔/張家蜜棗」除了採用安全交易模式外，並承諾負保密義務，除了為完成交易或提供顧客服務而提供給相關商品或服務之配合廠商以外，不會任意洩漏或提供給第三人。<br>
三、在下列情況下，「尋棗鹽埔/張家蜜棗」有權查看或提供您的個人資料給有權機關、或主張其權利受侵害並提出適當證明的第三人：<br>
&nbsp;&nbsp;&nbsp;1. 依法令規定、或依司法機關或其他有權機關的命令。<br>
&nbsp;&nbsp;&nbsp;2. 為完成交易或執行本約定條款、或您違反本約定條款。<br>
&nbsp;&nbsp;&nbsp;3. 為維護「尋棗鹽埔/張家蜜棗」系統的正常運作及安全。<br>
&nbsp;&nbsp;&nbsp;4. 為保護「尋棗鹽埔/張家蜜棗」、其他使用者或第三人的合法權益。<br>
</p>

<p align="left" style="font-size: 12pt;">參、線上訂購 </p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、在您完成線上訂購程序以後，本系統會自動經由電子郵件或其他方式寄給您一封通知，但是該項通知只是通知您本系統已經收到您的訂購訊息，不代表交易已經完成或契約已經成立，「尋棗鹽埔/張家蜜棗」保留是否接受您的訂單的權利。如果「尋棗鹽埔/張家蜜棗」確認交易條件無誤、付款完成、而且仍有存貨，「尋棗鹽埔/張家蜜棗」會直接通知配合廠商出貨，不另行通知。<br> 
二、您完成ATM轉帳，不代表交易已經完成或契約已經成立，「尋棗鹽埔/張家蜜棗」保留是否接受您的訂單的權利。如果「尋棗鹽埔/張家蜜棗」確認交易條件無誤、付款完成、而且仍有存貨，「尋棗鹽埔/張家蜜棗」會直接通知配合廠商出貨，不另行通知。若交易條件有誤、商品無存貨、服務無法提供或有「尋棗鹽埔/張家蜜棗」無法接受訂單之情形，「尋棗鹽埔/張家蜜棗」得主動為您辦理退款。<br> 
三、您所訂購的所有商品，關於其品質、保固及售後服務等，都是由果農張先生負責對您提供品質承諾、保固及售後服務等，「尋棗鹽埔/張家蜜棗」僅協助您解決關於因為線上消費所產生的疑問或爭議。<br> 
四、您一旦在「尋棗鹽埔/張家蜜棗」完成訂購程序，就表示您提出要約、願意依照本約定條款及相關網頁上所載明的交易條件或限制，訂購該商品或服務。您所留存的資料(如地址、電話)如有變更，應立即上線修改所留存的資料，而且不得以資料不符為理由，否認訂購行為或拒絕付款。<br> 
五、您所訂購的商品或服務，若經配送兩次無法送達、且經無法聯繫超過三天者，「尋棗鹽埔/張家蜜棗」將取消該筆訂單、並全額退款。<br> 
六、您在「尋棗鹽埔/張家蜜棗」所進行的所有線上消費，都以「尋棗鹽埔/張家蜜棗」電腦系統所自動紀錄的電子交易資料為準，如有糾紛，並以該電子交易資料為認定標準。如果您發現交易資料不正確，應立即通知「尋棗鹽埔/張家蜜棗」。</p>

<p align="left" style="font-size: 12pt;">肆、關於退貨退款</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、您在「尋棗鹽埔/張家蜜棗」所訂購的商品，如對商品有下列問題都可以在七天之內要求退貨退款：1.運輸過程造成商品毀損、2.商品項目錯誤、3.產品品質不良、4.非消費者失誤所造成之毀損；但是水果因屬生鮮食品，如有下列情況入不接受退換貨：<br>
&nbsp;&nbsp;&nbsp;1. 消費者人為造成商品毀損。<br>
&nbsp;&nbsp;&nbsp;2. 消費者明知定錯商品項目卻未於付款時兩天前通知。<br> 
二、若消費者之付款方式為貨到付款，退換貨請於收到商品後的24小時之內與果農張先生聯絡，如果非收到之商品有瑕疵或品質不良，商品不接受退換貨。<br> 
三、您所退回的商品，必須保持所有商品、附件、包裝、及所有附隨文件或資料的完整性，否則「尋棗鹽埔/張家蜜棗」得拒絕接受您的退貨退款要求。<br>
四、若有退換貨之情形發生，消費者須負擔送回商品之運費。</p>

<p align="left" style="font-size: 12pt;">伍、系統安全</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、本系統不以任何明示或默示的方式擔保您所上載或傳輸的資料將被正常顯示或處理、亦不擔保資料傳輸的正確性；如果您發現本系統有錯誤或疏失，請立即通知「尋棗鹽埔/張家蜜棗」。<br>
二、本系統會定期備份資料，但是除非本系統有故意或重大過失，本系統不對任何資料的失誤刪除、或備份錯誤或失敗負責。</p>

<p align="left" style="font-size: 12pt;">陸、約定條款的修改：</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、「尋棗鹽埔/張家蜜棗」保留隨時修改本約定條款的權利，修改後的約定條款將公佈在本網站上，不另外個別通知。如果您繼續在「尋棗鹽埔/張家蜜棗」進行線上訂購，就表示您已經了解、並同意遵守修改後的約定條款。</p>

<p align="left" style="font-size: 12pt;">柒、準據法及管轄權</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、您在「尋棗鹽埔/張家蜜棗」所進行的所有線上訂購、交易或行為，以及本約定條款，都以中華民國法令為準據法。<br> 
二、所有因為您在「尋棗鹽埔/張家蜜棗」進行線上訂購、交易或行為，以及因本約定條款所發生的糾紛，如果因此而發生涉訟，皆以台灣屏東地方法院為第一審管轄法院。</p>

	</div>

	<input type="submit" class="button11" name="agreebtn" id="button9" value="我同意" onClick="window.location.href='checkout.php';">
	<input type="button" class="button11" name="diagreebtn" id="button10" value="我不同意" onClick="window.location.href='cart.php';">
	
</div>
</div>
	<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
