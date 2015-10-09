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

		$start = $_POST['start'];
		
		if($_POST['waypoints']!=null)
		{
			$tempwaypoints = implode("*",$_POST['waypoints']);
			$checkboxArray = explode("*",$tempwaypoints);
			if(count($checkboxArray)>=6)
			{
			?>
				<script language="javascript">
					alert("溫馨提醒：\n旅遊行程之景點數量(不含起點與終點)，\n建議在5個以下為佳唷 : ) \n按下確認鍵後將返回上一頁。");
					window.location.href='route.php';
				</script>
			<?php
			}
		}
		$end = $_POST['end'];
		/*
		echo $start."<br>";
		for($i=0;$i<count($checkboxArray);$i++)
		{
			echo $checkboxArray[$i]."<br>";
		}
		echo $start."<br>";*/
	?>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>中央大學水果網站Beta</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script>

    var directionsDisplay;
	var directionsService = new google.maps.DirectionsService();
	var map;

	function initialize() {
		directionsDisplay = new google.maps.DirectionsRenderer();
		var initcenter = new google.maps.LatLng(22.749723, 120.583454);
		var mapOptions = {
			zoom: 11,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: initcenter
		}
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		
		directionsDisplay.setMap(map);
		var startt = "<?php echo $start; ?>";
		var endt = "<?php echo $end; ?>";
		var wayptst = [
		<?php
		for($i=0;$i<count($checkboxArray);$i++)
		{
			if($i==0)
			{
				echo '{location:"'.$checkboxArray[$i].'",stopover:true}';
			}
			else
			{
				echo ',{location:"'.$checkboxArray[$i].'",stopover:true}';
			}
		}
		?>
		];

	var request = {
		origin: startt,
		destination: endt,
		waypoints: wayptst,
		optimizeWaypoints: true,
		travelMode: google.maps.TravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
			var route = response.routes[0];
			var summaryPanel = document.getElementById('directions_panel');
			summaryPanel.innerHTML = '<?php echo '<div class="subjectDiv" align="center">旅途行程</div>'?>';
			// For each route, display summary information.
			for (var i = 0; i < route.legs.length; i++) {
				var routeSegment = i + 1;
				summaryPanel.innerHTML += '<br><b> ' + routeSegment + '：</b>';
				summaryPanel.innerHTML += route.legs[i].start_address + '　<b>到</b>　';
				summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
				summaryPanel.innerHTML += '<b>景點間距離：</b> ' + route.legs[i].distance.text + '<br>';
			}
		}
	}
	);
}

	google.maps.event.addDomListener(window, 'load', initialize);

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
		<div id="map-canvas" style="float:left;width:60%;height:95%;margin:5px 0 0 0px;"></div>
		<div id="control_panel" style="float:right;width:39%;text-align:left;">
			<div id="directions_panel" style="margin:5px;background-color:#FFEE77;"></div>
		</div>
		<input class="button11" type="button" name="button4" id="button4" value="回上一頁" onClick="window.history.back();">
	</div>
</div>
  <div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>