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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="http://maps.google.com/maps?file=api&v=2&sensor=false&key=ABQIAAAAaqKDpP2-EpyY6Dr1lzciMBRjjmidHcYQYoT7pNC7etAGb5K0kxQymQu6mKtkwxVAKQ_0y5EC2JEL0w"
            type="text/javascript"></script>
    <script src="css/markermanager.js"></script>
    <script type="text/javascript">
    	var map=null,categoriedMarker = new Array(14), mgr=null;

         //建立一個空的二為陣列存放要顯示的點
    	for (var k=0; k<14; k++)
			categoriedMarker[k]=[];

    function initialize() 
    {
      if (GBrowserIsCompatible()) 
      {
        map = new GMap2(document.getElementById("ee_map"));
        map.setCenter(new GLatLng(22.749723,120.583454), 11);
        //markermanager.js的功能,沒研究,直接拿來用就好
        mgr = new MarkerManager(map);

        map.setUIToDefault();
		
        addSite(map,'*大花有機農場-山水玩樂*',22.716640,120.488423, '山水玩樂-大花有機農場<br>地址：屏東縣九如路一段 台三線427K-428K之間</br>營業時間:09:00-17:00<br>簡介：大花有機農場位於南台灣屏東縣九如鄉機場附近，堅持有機栽培的信念，生產出最好的有機農產品，發展本土有機玫瑰和玫瑰周邊產品。</br>');
        addSite(map,'*巧堂串珠館-山水玩樂*',22.735467,120.500994, '山水玩樂-巧堂串珠館<br>地址:屏東縣九如鄉東寧村東寧路9號</br>營業時間:週二至週日（10:00-20:00）<br>簡介：在東寧路上順著一直走在右手邊可以看到很漂亮的歐式建築物，進入大門之後就可以看到很多由老闆親手用串珠做成的公仔，還可以親自買材料，由店家教您編制哦</br>');
        addSite(map,'*內埔老街-山水玩樂*',22.615080,120.566325, '山水玩樂-內埔老街<br>地址:屏東縣內埔鄉廣濟路與光明路交叉口</br>營業時間:全天<br>簡介:古色古香的建築風格、老舊門牌的整齊陳列、牆壁彩繪的藝術創作，聲畫重現，為這個充滿歷史故事的街道注入活力，彷彿引領著旅人們重回當年老街風華歲月。</br>');
        addSite(map,'*竹田車站-山水玩樂*',22.586461,120.541859, '山水玩樂-竹田車站<br>地址:屏東縣竹田鄉豐明路23號</br>營業時間:週二至週五（08:30-11:30及14:00-16:30）週六及週日（08:30-11:30）<br>簡介:竹田車站是民國29年建造，至今已超過一甲子的歲月，是臺灣鐵路屏東線上深具歷史價值的鐵路車站</br>');
        addSite(map,'*三地門大津瀑布-山水玩樂*',22.863062,120.634075 , '山水玩樂-三地門大津瀑布<br>地址:屏東縣高樹鄉新豐村泰和路117號</br>營業時間:全天<br>簡介:大津瀑布在大津風景區內，當地人稱它為「大烏瀑布」或「尾寮瀑布」，也有人叫它「新豐瀑布」。<br>瀑水自高山源頭俯衝直下，瀑布呈現90度，像是一條白裐自高處落下，又細又長，<br>景色非常宜人。</br>');
        addSite(map,'*海神宮風景區-山水玩樂*',22.824757,120.660253, '山水玩樂-海神宮風景區<br>地址:屏東縣三地門鄉青山村</br>營業時間:全天<br>簡介:海神宮風景區山勢險峻、溪水潔淨，是片渾然天成的峽谷，有着峭壁、深潭、峽谷、巨岩等景觀。此處溪水不深，水質清澈，許多魚蝦在其間游動，且流速平穩，不論溯溪、<br>戲水、野餐、露營等活動皆很適合。<br>');
		addSite(map,'*山中天休閒山莊-山水玩樂*',22.715024,120.645726, '山水玩樂-山中天休閒山莊<br>地址:屏東縣三地門鄉三地村中正路一段10之一號</br>營業時間:全天<br>簡介:山中天休閒山莊，是夢想的開端，也是夢醒的開始。隨著車行漸遠，都市、大街、人潮慢慢從後視鏡中消失，取而代之的是滿眼翠綠和無邊藍天。</br>');
		
		
		addSite(map,'*里港文富餛飩豬腳-美食*',22.777297,120.493107 , '美食-里港文富餛飩豬腳<br>地址:屏東縣里港鄉永樂路 8 號</br>營業時間:08:00-21:00<br>簡介:店裡的餛飩和水煮豬腳非常好吃，而永樂路2 號 和 8 號都各有一間文富餛飩豬腳，都是不同親戚開的，一樣都很美味。</br>');
		addSite(map,'*泉和冰室-美食*',22.777043 ,120.493947, '美食-泉和冰室<br>地址:屏東縣里港鄉大平村仁和路 34 號</br>營業時間:週一至週日（08:00-23:00）<br>簡介:家有六十年歷史的冰店，店名叫泉和冰室，冰室是早期冰店的說法，當時有很多冰店都叫冰果室，由此可見這家店在地經營真的很久，值得一試。</br>');
		addSite(map,'*大路關老麵店-美食*',22.759046,120.617402, '美食-大路關老麵店<br>地址:屏東縣高樹鄉廣福村中正路1-1號</br>營業時間:08：00-20：00（週三公休）');
		addSite(map,'*張家果園&大鴕家-美食*',22.749723,120.583454, '美食-張家果園&大鴕家<br>地址:屏東縣鹽埔鄉鹽中村民富路86號</br>電話:08-7931786<br>簡介:張家果園為此網站蜜棗蓮霧的產地，大鴕家提供餐廳、休閒等服務</br>');
		
		
		addSite(map,'*屏東青島街將軍之屋-地方風俗文化*',22.678698,120.484395, '地方風俗文化-屏東青島街將軍之屋<br>地址:屏東市青島街106號</br>營業時間:週二至週日（09:00-12:00及13:30-17:30）<br>簡介:日治時期1920年，全台有史以來第一座機場－「屏東飛行場」完工。</br>');
		addSite(map,'*六堆客家文化中心-地方風俗文化*',22.658419,120.558816, '地方風俗文化-六堆客家文化中心<br>地址:屏東縣內埔鄉建興村信義路588號</br>營業時間:08:00-20:00<br>簡介:六堆地區是臺灣客家人最早聚居的地方。六堆文化園區為保存、展現高屏兩縣12鄉鎮客庄之客家生活風貌，扶植六堆聚落文化產業的國家級區域文化設施。</br>');
		addSite(map,'*原住民文化三地門鄉-地方風俗文化*',22.716667,120.650000, '地方風俗文化-原住民文化三地門鄉<br>簡介:原住民文化</br>');
		
      }
    }
    
	function addSite(map, siteTitle, lat, lng, siteDesc) {
		var mark = new GMarker(new GLatLng(lat,lng), {title:siteTitle});
		map.addOverlay(mark);
		GEvent.addListener(mark, "click", function() {mark.openInfoWindowHtml(siteDesc);}); 
		
                            //根據點的名稱分別放入二維陣列
			if(siteTitle.substring(1,3)=='大花')
				categoriedMarker[0].push(mark);
			    else if(siteTitle.substring(1,3)=='巧堂')
				categoriedMarker[1].push(mark);
			    else if(siteTitle.substring(1,3)=='內埔')
				categoriedMarker[2].push(mark);
				else if(siteTitle.substring(1,3)=='竹田')
				categoriedMarker[3].push(mark);
				else if(siteTitle.substring(1,3)=='三地')
				categoriedMarker[4].push(mark);
				else if(siteTitle.substring(1,3)=='海神')
				categoriedMarker[5].push(mark);
				else if(siteTitle.substring(1,3)=='山中')
				categoriedMarker[6].push(mark);
	
				
			    else if(siteTitle.substring(1,3)=='里港')
				categoriedMarker[7].push(mark);
		        else if(siteTitle.substring(1,3)=='泉和')
				categoriedMarker[8].push(mark);
				else if(siteTitle.substring(1,3)=='大路')
				categoriedMarker[9].push(mark);
				else if(siteTitle.substring(1,3)=='張家')
				categoriedMarker[10].push(mark);
				else if(siteTitle.substring(1,3)=='屏東')
				categoriedMarker[11].push(mark);
				else if(siteTitle.substring(1,3)=='六堆')
				categoriedMarker[12].push(mark);
				else if(siteTitle.substring(1,3)=='原住')
				categoriedMarker[13].push(mark);
			
			
				
	}
	
 	 function show(ctgIdx) {
 	 	mgr.addMarkers( categoriedMarker[ctgIdx],3);
 	 	mgr.refresh();
    }
	
    function hide(ctgIdx) {
    	map.closeInfoWindow();
    	for (var i=0;i<categoriedMarker[ctgIdx].length;i++)
    		mgr.removeMarker(categoriedMarker[ctgIdx][i]);
    }

function unselAll() {//變數checkItem為checkbox的集合
var checkItem = document.getElementsByName("waypoints[]");
for(var i=0;i<checkItem.length;i++){
checkItem[i].checked=false;
}}
	function transcalcRoute() {
	window.location.href = 'mapresult.php';
	}
    </script>
</head>

<body onload="initialize()" onunload="GUnload()">
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
	
		<br><div class="subjectDiv">行程建議</div>
		<div style="margin:5px;">
		<form action="mapresult.php" method="post" name="form1">
		<a class="titleDiv">請選取旅途起始點</a>
		<select id="start" name="start">
		<option value="台灣屏東縣九如鄉九如路一段16號">山水玩樂-大花有機農場</option>
		<option value="台灣屏東縣九如鄉東寧村東寧路9號">山水玩樂-巧堂串珠館</option>
		<option value="台灣屏東縣內埔鄉廣濟路154號">山水玩樂-內埔老街</option>
		<option value="台灣屏東縣竹田鄉豐明路23號">山水玩樂-竹田車站</option>
		<option value="屏東縣高樹鄉新豐村泰和路117號">山水玩樂-三地門大津瀑布</option>
		<option value="台灣屏東縣三地門鄉沙溪林道">山水玩樂-海神宮風景區</option>
		<option value="屏東縣三地門鄉三地村中正路一段10之一號">山水玩樂-山中天休閒山莊</option>
		<option value="屏東縣里港鄉永樂路8號">美食-里港文富餛飩豬腳</option>
		<option value="屏東縣里港鄉大平村仁和路34號">美食-泉和冰室</option>
		<option value="屏東縣高樹鄉廣福村中正路1-1號">美食-大路關老麵店</option>
		<option value="屏東縣鹽埔鄉鹽中村民富路86號">美食-張家果園&大鴕家</option>
		<option value="屏東市青島街106號">地方風俗文化-屏東青島街將軍之屋</option>
		<option value="屏東縣內埔鄉建興村信義路588號">地方風俗文化-六堆客家文化中心</option>
		<option value="台灣屏東縣三地門鄉三地部落至賽嘉部落聯絡道路">地方風俗文化-三地門鄉</option>
		</select>
		<br>
		<a class="titleDiv">請選取旅途終點</a>
		<select id="end" name="end">
		<option value="台灣屏東縣九如鄉九如路一段16號">山水玩樂-大花有機農場</option>
		<option value="台灣屏東縣九如鄉東寧村東寧路9號">山水玩樂-巧堂串珠館</option>
		<option value="台灣屏東縣內埔鄉廣濟路154號">山水玩樂-內埔老街</option>
		<option value="台灣屏東縣竹田鄉豐明路23號">山水玩樂-竹田車站</option>
		<option value="屏東縣高樹鄉新豐村泰和路117號">山水玩樂-三地門大津瀑布</option>
		<option value="台灣屏東縣三地門鄉沙溪林道">山水玩樂-海神宮風景區</option>
		<option value="屏東縣三地門鄉三地村中正路一段10之一號">山水玩樂-山中天休閒山莊</option>
		<option value="屏東縣里港鄉永樂路8號">美食-里港文富餛飩豬腳</option>
		<option value="屏東縣里港鄉大平村仁和路34號">美食-泉和冰室</option>
		<option value="屏東縣高樹鄉廣正福村中路1-1號">美食-大路關老麵店</option>
		<option value="屏東縣鹽埔鄉鹽中村民富路86號">美食-張家果園&大鴕家</option>
		<option value="屏東市青島街106號">地方風俗文化-屏東青島街將軍之屋</option>
		<option value="屏東縣內埔鄉建興村信義路588號">地方風俗文化-六堆客家文化中心</option>
		<option value="台灣屏東縣三地門鄉三地部落至賽嘉部落聯絡道路">地方風俗文化-三地門鄉</option>
		</select>
		<br>
		<a class="titleDiv">勾選欲遊玩景點，點選地圖標示可以顯示遊玩資訊</a><br>
				 <a class="AdDiv" style="color:#58FAF4;">山水玩樂</a>
    <input type="checkbox"   name="waypoints[]" checked onClick="this.checked==true?show(0):hide(0)" value="台灣屏東縣九如鄉九如路一段16號" />
大花有機農場
<input type="checkbox"   name="waypoints[]" checked onClick="this.checked==true?show(1):hide(1)" value="台灣屏東縣九如鄉東寧村東寧路9號"/>
巧堂串珠館
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(2):hide(2)" value="台灣屏東縣內埔鄉廣濟路154號"/>
內埔老街
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(3):hide(3)" value="台灣屏東縣竹田鄉豐明路23號"/>
竹田車站 
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(4):hide(4)" value="屏東縣高樹鄉新豐村泰和路117號"/>
三地門大津瀑布<br>
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(5):hide(5)" value="台灣屏東縣三地門鄉沙溪林道"/>
海神宮風景區
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(6):hide(6)" value="屏東縣三地門鄉三地村中正路一段10之一號"/>
山中天休閒山莊<br clear="all" />
     <a class="AdDiv" style="color:#58FAF4;">美食</a>    
    <input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(7):hide(7)" value="屏東縣里港鄉永樂路8號"/>
里港文富餛飩豬腳
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(8):hide(8)" value="屏東縣里港鄉大平村仁和路34號"/>
泉和冰室 
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(9):hide(9)" value="屏東縣高樹鄉廣正福村中路1-1號"/>
大路關老麵店
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(10):hide(10)" value="屏東縣鹽埔鄉鹽中村民富路86號"/>
張家果園&大鴕家<br>
    <a class="AdDiv" style="color:#58FAF4;">地方風俗文化</a>
    <input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(11):hide(11)" value="屏東市青島街106號"/>
屏東青島街將軍之屋
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(12):hide(12)" value="屏東縣內埔鄉建興村信義路588號"/>
六堆客家文化中心
<input type="checkbox"  name="waypoints[]" checked onClick="this.checked==true?show(13):hide(13)" value="台灣屏東縣三地門鄉三地部落至賽嘉部落聯絡道路"/>
原住民文化三地門鄉<br>
<input type="button" class="button11" value="重新選擇" name="c2" onclick="unselAll()& hide(0)& hide(1)& hide(2)& hide(3)& hide(4)& hide(5)& hide(6)& hide(7)& hide(8)& hide(9)& hide(10)& hide(11)& hide(12)& hide(13)"/>

			<input name="submit" class="button11" type="submit" value="行程規劃">
		</form>
	</div>
	
	<div id="ee_map" style="float:left;width:99%;height:55%; margin:5px 0px 0px 0px;"></div>
	</div>
</div>
  <div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
