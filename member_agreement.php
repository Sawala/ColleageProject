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
		<br><div class="subjectDiv">「尋棗鹽埔/張家蜜棗」 會員服務使用條款</div><br>

		<div class="boxed" style="overflow-y:auto">
		


<p align="left" style="font-size: 12pt; line-height: 160%;">歡迎您加入成為「尋棗鹽埔/張家蜜棗」的會員，尋棗鹽埔/張家蜜棗會員服務(以下稱會員服務)係由「尋棗鹽埔/張家蜜棗水果購物網站」(以下稱本網站)所建置與提供，所有使用會員服務的使用者(以下稱會員)，都應該詳細閱讀下列約定條款，以下約定條款訂立之目的，為保護會員服務的提供者以及所有使用者的利益，並構成使用者與會員服務提供者之間的契約，使用者完成註冊手續、或開始使用「尋棗鹽埔/張家蜜棗」所提供的會員服務時，就視為已知悉、並完全同意本使用條款的所有約定：</p>

<p align="left" style="font-size: 12pt;">壹、會員服務</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、本網站完成並確認會員申請後，將依本網站之系統當時所建置的服務管道、項目、內容、狀態及功能，對會員提供服務；本網站保留隨時新增、減少或變更各該服務管道、項目、內容及功能之全部或一部之權利，且不另行個別通知。<br>
二、本網站保留隨時變更免費服務為收費服務、以及變更收費標準之權利，變更後之內容，除公佈於各該網頁外，不另行個別通知。<br>
三、部分會員服務可能另訂有相關使用規範或約定，會員應同時遵守各該服務管道或項目之使用規範及相關約定。</p>

<p align="left" style="font-size: 12pt;">貳、帳號、密碼與安全性</p> 

<p align="left" style="font-size: 12pt; line-height: 160%;">一、會員應完成註冊程序、提供會員註冊或交易流程中所要求的資料，並應擔保所提供的所有資料都是正確且即時的資料，如果會員所提供的資料事後有變更，會員應即時更新所留存的資料。如果會員未即時提供資料、未按指定方式提供資料、或所提供之資料不正確或與事實不符，本網站保留不經事先通知，隨時拒絕或暫停對該會員提供相關服務之全部或一部之權利。<br>
二、會員可以自行選擇使用者名稱和密碼，但會員有妥善自行保管和保密的義務，不得透漏或提供予第三人使用，對於使用特定使用者名稱和密碼使用會員服務之行為、以及登入系統後之所有行為，均應由持有該使用者名稱和密碼之會員負責。<br>
三、會員如果發現或懷疑其使用者名稱和密碼被第三人冒用或不當使用，會員應立即通知本網站，以利本網站及時採取適當的因應措施；但上述因應措施不得解釋為本網站因此而明示或默示對會員負有任何形式之賠償或補償義務。</p>

<p align="left" style="font-size: 12pt;">參、個人資料保護 </p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、本網站會保護每一位會員的個人資料，對於會員所提供的個人資料，除了會員可能涉及違法、侵權、違反本使用條款或各該服務之使用規範或約定、或經本人同意外，本網站不會將會員個人資料提供給第三方。<br> 
二、部分會員服務是由本網站合作夥伴所經營或提供服務，為對會員提供該等服務，可能必須將會員的個人資料提供給該等合作夥伴，即進行商品運送時會員所填寫的收件資料，將提供給配合商品配送之廠商黑貓宅急便。<br> 
三、在下列的情況下，本網站有可能會查看或提供會員的個人資料或相關電信資料給相關政府機關、或主張其權利受侵害並提出適當證明之第三人：<br> 
	&nbsp;&nbsp;&nbsp;1. 依法令規定、或依司法機關或其他相關政府機關的命令。<br> 
	&nbsp;&nbsp;&nbsp;2. 會員涉及違反法令、侵害第三人權益、或違反本使用條款或各該使用規範或約定。<br> 
	&nbsp;&nbsp;&nbsp;3. 為保護會員服務系統之安全或經營者之合法權益。<br> 
	&nbsp;&nbsp;&nbsp;4. 為保護其他使用者或其他第三人的合法權益。<br> 
	&nbsp;&nbsp;&nbsp;5. 為維護本系統的正常運作。</p>

<p align="left" style="font-size: 12pt;">肆、資料儲存</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、會員應自行備份其所上傳、刊載或儲存於本系統內的所有資料。本網站將依當時本系統所設定之方式及處理能量，定期備份會員所儲存的資料，但不擔保會員所儲存的資料將全部被完整備份；會員同意，本網站不需對未備份、已刪除的資料或備份儲存失敗的資料負責。<br> 
二、本系統不擔保會員所上載的資料將被正常顯示、亦不擔保資料傳輸的正確性；如果會員發現本系統有錯誤或疏失，請立即通知本系統網站管理者。<br> 
三、本系統會偵測一定期間沒有使用的會員帳號，對於一定期間未登入使用之會員帳號，本系統將可能除該使用者帳號之所有郵件、檔案、使用者設定資料檔及相關資料，且不予另行備份，並暫停該使用者帳號之使用。有無登入使用之紀錄，以本網站會員服務系統內所留存之紀錄為準。</p>

<p align="left" style="font-size: 12pt;">伍、會員服務之提供及使用</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、本網站僅提供已註冊會員進行站內商品購買、商品評分以及意見回饋之服務，其他本網站未提及與未提供之服務與功能，為本網站所禁止之事項，並禁止將本網站之會員帳號、資料用於其他可能涉及違法、侵權、違反本使用條款規範或約定之事項。</p>

<p align="left" style="font-size: 12pt;">陸、使用者行為</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、會員不得為未經事前授權的商業行為。<br> 
二、會員上傳或刊載於各類會員服務內的資訊（包括且不限於文字、圖片、影片、檔案或其他資料），均由電腦系統自動依會員之指令，上傳、刊載或儲存於各類會員服務相關網頁及位置，本網站不負責審查、核對或編輯。<br> 
三、會員必須遵守相關法令規範，且不得從事下列行為：<br> 
	&nbsp;&nbsp;&nbsp;1. 傳送任何違反中華民國技術資料輸出等相關法令之郵件、檔案或資料。<br> 
	&nbsp;&nbsp;&nbsp;2. 刊載、傳輸、發送或儲存任何誹謗或妨害他人名譽或商譽、詐欺、猥褻、色情、賭博、違反公序良俗或其他違反法令之郵件、圖片、檔案或資料。<br> 
	&nbsp;&nbsp;&nbsp;3. 刊載、傳輸、發送或儲存任何侵害他人智慧財產權或其他權益的著作或資料。<br> 
	&nbsp;&nbsp;&nbsp;4. 未經同意收集他人電子郵件位址以及其他個人資料。<br> 
	&nbsp;&nbsp;&nbsp;5. 未經同意擅自摘錄或使用會員服務內任何資料庫內容之全部或一部。<br> 
	&nbsp;&nbsp;&nbsp;6. 刊載、傳輸、發送、儲存病毒、或其他任何足以破壞或干擾電腦系統或資料的程式或訊息。<br> 
	&nbsp;&nbsp;&nbsp;7. 破壞或干擾會員服務的系統運作或違反一般網路禮節之行為。<br> 
	&nbsp;&nbsp;&nbsp;8. 在未經授權下進入會員服務系統或是與系統有關之網路，或冒用他人帳號或偽造寄件人辨識資料傳送郵件，企圖誤導收件人之判斷。<br> 
	&nbsp;&nbsp;&nbsp;9. 任何妨礙或干擾其他使用者使用會員服務之行為。<br> 
	&nbsp;&nbsp;&nbsp;10. 傳送垃圾郵件、廣告信或其他無目的之郵件。<br> 
	&nbsp;&nbsp;&nbsp;11. 任何透過不正當管道竊取會員服務之會員帳號、密碼或存取權限之行為。<br> 
	&nbsp;&nbsp;&nbsp;12. 其他不符合會員服務所提供的使用目的之行為。<br> 
四、如果會員或第三人所上傳、刊載、傳輸、發送或儲存之任何文字、圖片、影片、檔案或其他著作或資料，有任何違反法令或侵害第三人權益之虞、或違反本使用條款或其他使用規範或約定、或經第三人主張涉及侵權或其他合法性爭議，本網站有權隨時不經通知，直接加以刪除、移動或停止存取，或對各該會員停止提供會員服務之全部或一部；為該等行為之會員，除須自負因此所生之法律責任外，對於本網站因此所受之損害及所支出之費用，並應負賠償及償還之責任。</p>

<p align="left" style="font-size: 12pt;">柒、權利歸屬及會員對本網站的授權</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、會員服務所提供的所有網頁設計、介面、URL、商標或標識、電腦程式、資料庫等，其商標、著作權、其他智慧財產權及資料所有權等，均屬於本網站或授權本網站使用之合法權利人所有。<br> 
二、會員自行上傳、刊載及儲存於會員服務內之所有著作及資料，其著作權或其他智慧財產權仍然歸會員或授權會員使用之合法權利人所有；但會員除必須擔保該等著作或資料絕無違反法令或侵害第三人權益外，並同意授權本網站得儲存、刊載於網站上。</p>

<p align="left" style="font-size: 12pt;">捌、責任排除及限制</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、對於本網站所提供之各項會員服務，均僅依各該服務當時之功能及現況提供使用，對於使用者之特定要求或需求，包括但不限於速度、安全性、可靠性、完整性、正確性及不會斷線和出錯等，本網站不負任何明示或默示之擔保或保證責任。<br> 
二、本網站不保證任何郵件、檔案或資料之傳送及儲存均係可靠且正確無誤，亦不保證所儲存或所傳送之郵件、檔案或資料之安全性、可靠性、完整性、正確性及不會斷線和出錯等，因各該郵件、檔案或資料傳送或儲存失敗、遺失或錯誤等所致之損害，本網站不負賠償責任。<br> 
三、因本網站所提供的會員服務本身之使用，所造成之任何直接或間接之損害，本網站不負任何賠償責任，即使係本網站曾明白提示注意之建議事項亦同。</p>

<p align="left" style="font-size: 12pt;">玖、服務暫停或中斷</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、會員服務系統或功能之例行性維護、改置或變動所發生之服務暫停或中斷，本網站將於暫停或中斷前，以電子郵件、公告或其他適當之方式告知會員。<br> 
二、在下列情形，本網站將暫停或中斷會員服務之全部或一部，且對使用者因此所受之所有直接或間接損害，不負賠償責任：<br> 
	&nbsp;&nbsp;&nbsp;1. 對會員服務相關軟硬體設備進行搬遷、更換、升級、保養或維修時。<br> 
	&nbsp;&nbsp;&nbsp;2. 使用者有任何違反法令、本使用條款或各該使用規範及約定之情形。<br> 
	&nbsp;&nbsp;&nbsp;3. 因第三人之行為、天災或其他不可抗力所致之會員服務停止或中斷。<br> 
	&nbsp;&nbsp;&nbsp;4. 因其他非本網站所得完全控制或不可歸責於本網站之事由所致之會員服務停止或中斷。</p>

<p align="left" style="font-size: 12pt;">拾、終止服務</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、基於網站運作，本網站保留隨時停止提供會員服務之全部或一部之權利，除對於付費服務按比例退還已收取而未使用之費用外，本網站不因此而對會員負賠償或補償之責任。<br> 
二、如會員違反本使用條款或各該會員服務之使用規範或約定，本網站保留隨時暫時停止提供服務、或終止提供服務之權利，且不因此而對會員負任何賠償或補償之責任。</p>

<p align="left" style="font-size: 12pt;">拾壹、本使用條款之修改</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、本網站保留隨時修改本會員服務使用條款及各該使用規範或約定之權利，修改後的內容，將公佈在會員服務相關網頁上，不另外個別通知使用者。</p>

<p align="left" style="font-size: 12pt;">拾貳、準據法及管轄權</p>

<p align="left" style="font-size: 12pt; line-height: 160%;">一、本使用條款及各該會員服務之相關使用規範及約定，均以中華民國法令為準據法。<br> 
二、因會員服務、或本使用條款及各該會員服務之相關使用規範及約定所發生之爭議，如因此而訴訟，以台灣屏東地方法院為第一審管轄法院。</p>

	</div>

	<input type="submit" name="agreebtn" id="button7" value="我同意" onClick="window.location.href='member_join.php';">
	<input type="button" name="diagreebtn" id="button8" value="我不同意" onClick="window.location.href='member_index.php';">
	
</div>
</div>
	<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
