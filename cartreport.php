<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
if(isset($_POST["customername"]) && ($_POST["customername"]!="")){
	//購物車開始
	require_once("mycart.php");
	if(!isset($_SESSION))
	{
		session_start();
	}
	$cart =& $_SESSION['cart']; // 將購物車的值設定為 Session
	
	//轉換取貨時間
	if($_POST["pickuptime"]==1)
	{
		$pickuptimetemp='早上';
	}
	elseif($_POST["pickuptime"]==2)
	{
		$pickuptimetemp='下午';
	}
	else
	{
		$pickuptimetemp='晚上';
	}
	
	if(!is_object($cart)) $cart = new myCart();
	//購物車結束	
	//新增訂單資料
	$sql_query = "INSERT INTO `order` (`total` ,`deliverfee` ,`grandtotal` ,`customername` ,`customeremail` ,`customeraddress` ,`customerphone` ,`paytype`,`date` , `pickuptime`) VALUES (";
	$sql_query .= $cart->total.",";
	$sql_query .= $cart->deliverfee.",";
	$sql_query .= $cart->grandtotal.",";
	$sql_query .= "'".$_POST["customername"]."',";
	$sql_query .= "'".$_POST["customeremail"]."',";
	$sql_query .= "'".$_POST["customeraddress"]."',";
	$sql_query .= "'".$_POST["customerphone"]."',";
	$sql_query .= "'".$_POST["paytype"]."',";
	$sql_query .= "'".$_REQUEST["date1"]."',";
	$sql_query .= "'".$pickuptimetemp."')";
	mysql_query($sql_query);
	//取得新增的訂單編號
	$o_pid = mysql_insert_id();
	$query_RecDetail = "SELECT * FROM `orderdetail` WHERE `orderid`='".$o_pid."'";
	$RecDetail = mysql_query($query_RecDetail);
	$row_RecDetail=mysql_fetch_assoc($RecDetail);
	
	$tempcount = 0;//計算總盒數
	$temptotal = 0;
	//新增訂單內貨品資料
	if($cart->itemcount > 0) {
	$buyproduct = "";
		foreach($cart->get_contents() as $item)
		{
			$sql_query="INSERT INTO `orderdetail` (`orderid` ,`productid` ,`productname` ,`unitprice` ,`quantity`) VALUES (";
			$sql_query .= $o_pid.",";
			$sql_query .= $item['id'].",";
			$sql_query .= "'".$item['info']."',";
			$sql_query .= $item['price'].",";
			$sql_query .= $item['qty'].")";	
			mysql_query($sql_query);
			$buyproduct .= $item['info']." 購買了 ".$item['qty']." 個<br>";
			
			$tempcount += $item['qty'];
			$temptotal += number_format($item['subtotal']);//計算沒有運費的總金額
		}
		if($tempcount == 1)//如果買一盒，要付運費
		{
			$total = $cart->grandtotal;
		}
		else//如果>=2盒，免運費
		{
			$total = $temptotal;
		}
	}
	
	include("PHPMailer_5.2.1/class.phpmailer.php"); //匯入PHPMailer類別
   
	$mail= new PHPMailer();//建立新物件
	$mail->IsSMTP();//設定使用SMTP方式寄信
	$mail->SMTPAuth = true; //設定SMTP需要驗證
	$mail->SMTPSecure = "ssl";// Gmail的SMTP主機需要使用SSL連線
	$mail->Host = "smtp.gmail.com";  //Gamil的SMTP主機
	$mail->Port = 465;//Gamil的SMTP主機的SMTP埠位為465埠。
	$mail->CharSet = "utf-8";//設定郵件編碼        

	$mail->Username = "ncuisqlab12";  //Gmail帳號
	$mail->Password = "misteam12";  //Gmail密碼        

	//顧客郵寄通知
	$cname = $_POST["customername"];//客戶姓名
	$cmail = $_POST["customeremail"];
	$rname = $POST["recipient"];//收件人姓名
	$ctel = $_POST["customerphone"];//收件人電話
	$caddress = $_POST["customeraddress"];
	$cpaytype = $_POST["paytype"];
	$gettime = $_POST["$myCalendar"];//仲儼信會用到
	$deliverdate = $_REQUEST["date1"];
	//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
	$mail->Body = "
	<html>
		<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		</head>
		<body>
			<div align=\"center\" style=\"float: left; width: 85%;\">
				<p style=\"font-size: 18px; font-weight: bold; color: #F00;\">※ 此為系統自動發送之通知信，請勿直接回覆此信，謝謝。</p>
				▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂<br><br>
				<span style=\"font-size: 16px; font-weight: bold; color: #0066CC;\">尋棗/張家果園　網路水果購物</span>
				<br>
				<span style=\"font-size: 16px; font-weight: bold; color: #0066CC;\">商　品　訂　購　通　知</span>
				<br>
				▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂
				<br>
				<br>
			</div>
			<div align=\"left\" style=\"float: left; width: 85%;\">
				親愛的 $cname 您好<br>
				<br>
				謝謝您在　尋棗/張家果園　購買產品！<br>
				<br>
				<br>
				<span style=\"font-size: 16px; font-weight: bold; color: #0066CC;\">本次訂購商品資訊</span>
				<br>----------------------------------------------------------<br>
				訂單編號： $o_pid <br>
				購買產品： $buyproduct
				消費金額： 新台幣 $total 元 <br>
				您所訂購的商品將於 $deliverdate 的 $pickuptimetemp 到達<br>
				您的付款方式： $cpaytype<br>
				----------------------------------------------------------<br>
				<br>
				<br>
				<span style=\"font-size: 16px; font-weight: bold; color: #0066CC;\">收件人資訊</span>
				<br>----------------------------------------------------------<br>
				收件人姓名： $rname <br>
				收件人電話： $ctel <br>
				收件人地址： $caddress <br>
				----------------------------------------------------------<br>
				<br>
				<br>
				<span style=\"font-size: 16px; font-weight: bold; color: #0066CC;\">匯款資訊</span>
				<br>
				<span style=\"font-size: 12px; color: #F00;\">(若您選擇貨到付款可不予理會)</span>
				<br>----------------------------------------------------------<br>
				匯款郵局代碼：700<br>
				匯款戶名：張閔升<br>
				匯款郵局帳戶：00711190318107<br>
				----------------------------------------------------------<br>
				<br><br>
				謝謝您的支持，希望能再次為您服務！<br>
				<br>
				<br>
				<p align=\"right\">祝　購物愉快！</p>
				<br>
				<p align=\"right\">尋棗/張家果園　敬上</p>
				<p align=\"right\">如有疑問，請洽 0933-292-662 張先生</p>
			</div>
		</body>
	</html>
	";
	
	$mail->From = "ncuisqlab12@gmail.com"; //設定寄件者信箱
	$mail->FromName = "尋棗/張家果園";//設定寄件者姓名
	$mail->Subject = "尋棗/張家果園 商品訂購通知"; //設定郵件標題
	
	$mail->IsHTML(true);//設定郵件內容為HTML
	$mail->AddAddress($cmail, $cname); //設定收件者郵件及名稱

	if(!$mail->Send())
	{
		?>
		<script language="javascript">
			alert("郵寄失敗。\n\t按下確認鍵將返回購物首頁");
			window.location.href="index.php";
		</script>
		<?php
	}
	

    //仲儼信
	$mail->Body = "
	<html>
		<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		</head>
		<body>
			<div align=\"left\" style=\"float: left;\">
				陳仲儼 教授您好：<br>
				下列為本次訂單之資訊與客戶內容<br>
				--------------------------------------------------<br>
				<a style=\"font-size: 16px; color: #0066CC;\">訂單編號：</a> $o_pid <br>
				<a style=\"font-size: 16px; color: #0066CC;\">客戶姓名：</a> $cname <br>
				<a style=\"font-size: 16px; color: #0066CC;\">客戶電子郵件：</a> $cmail <br>
				<a style=\"font-size: 16px; color: #0066CC;\">收件人姓名：</a> $rname <br>
				<a style=\"font-size: 16px; color: #0066CC;\">收件人電話：</a> $ctel <br>
				<a style=\"font-size: 16px; color: #0066CC;\">收件人住址：</a> $caddress <br>
				<a style=\"font-size: 16px; color: #0066CC;\">付款方式：</a> $cpaytype <br>
				<a style=\"font-size: 16px; color: #0066CC;\">消費金額：</a> $total <br>
				<a style=\"font-size: 16px; color: #0066CC;\">到貨日期：</a> $deliverdate<br>
				<a style=\"font-size: 16px; color: #0066CC;\">到貨時段：</a> $pickuptimetemp<br>
				<a style=\"font-size: 16px; color: #0066CC;\">購買產品內容：</a> $buyproduct
				--------------------------------------------------<br>
			</div>
		</body>
	</html>
	";
	
	
	$mail->From = "ncuisqlab12@gmail.com"; //設定寄件者信箱
	$mail->FromName = "尋棗/張家果園";//設定寄件者姓名
	$mail->Subject = "尋棗/張家果園訂單通知"; //設定郵件標題
	$mailtoCCY = "kkk0292813@yahoo.com.tw";
	
	$mail->IsHTML(true);//設定郵件內容為HTML
	$mail->AddAddress($mailtoCCY, $cname); //設定收件者郵件及名稱

	if(!$mail->Send())
	{
		?>
		<script language="javascript">
			alert("郵寄失敗。\n\t按下確認鍵將返回購物首頁");
			window.location.href="index.php";
		</script>
		<?php
	}
	//清空購物車
	$cart->empty_cart();
}
?>