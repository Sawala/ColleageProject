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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<!--[if IE 6]>
<html id="ie6" dir="ltr" lang="zh-TW">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" dir="ltr" lang="zh-TW">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" dir="ltr" lang="zh-TW">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html dir="ltr" lang="zh-TW">
<!--<![endif]-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>中央大學水果網站Beta</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 
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
		<div id="Rotator">
			<!-- Begin DWUser_EasyRotator -->
			<script type="text/javascript" src="http://c520866.r66.cf2.rackcdn.com/1/js/easy_rotator.min.js"></script>
			<div class="dwuserEasyRotator" style="width: 665px; height: 374px; position:relative; text-align: left;" data-erConfig="{autoplayEnabled:true, lpp:'102-105-108-101-58-47-47-47-67-58-47-85-115-101-114-115-47-80-75-74-47-68-111-99-117-109-101-110-116-115-47-69-97-115-121-82-111-116-97-116-111-114-80-114-101-118-105-101-119-47-112-114-101-118-105-101-119-95-115-119-102-115-47', wv:1, autoplayDelay:4000, autoplayGalleryLoop:true, autoplayStopOnInteraction:false}" data-erName="Rotator" data-erTID="{f7jlcarcmj8515266404731}" data-erAudioConfig="{autoplay:false}">
				<div data-ertype="content" style="display: none;"><ul data-erlabel="Main Category">
					<li>
					<a class="mainLink" href="scenery.php"><img class="main" src="images/indexlandscape/鹽埔鄉.jpg" alt="Yanpu1" /></a>
						<img class="thumb" src="images/indexlandscape/鹽埔鄉.jpg" />
						<span class="title">您好！這裡是鹽埔鄉</span>
						<span class="desc">歡迎來到鹽埔</span>
					</li>
					<li>
						<a class="mainLink" href="bigbirdhome.php"><img class="main" src="images/indexlandscape/鹽埔2.jpg" alt="Yanpu2" /></a>
						<img class="thumb" src="images/indexlandscape/鹽埔2.jpg" />
						<span class="title">大鴕家鴕鳥觀光農園</span>
						<span class="desc">歡迎來大鴕家參觀</span>
					</li>
					<li>
						<img class="main" src="images/indexlandscape/鹽埔3.jpg" alt="Yanpu3" />
						<img class="thumb" src="images/indexlandscape/鹽埔3.jpg" />
						<!--<span class="title">想知道鹽埔嗎？</span>-->
						<span class="desc">讓我們向您娓娓道來鹽埔的一點一滴</span>
					</li>
					<li>
					<a class="mainLink" href="showproduct.php?cid=1"><img class="main" src="images/indexlandscape/鹽埔4.JPG" alt="Yanpu4" /></a>
						<img class="thumb" src="images/indexlandscape/鹽埔4.JPG" />
						<span class="title">不容錯過全台最好吃的蜜棗</span>
						<span class="desc">來自鹽埔，品質一級棒</span>
					</li>
					<!--<li>
						<a class="mainLink" href="showproduct.php?cid=2"><img class="main" src="images/indexlandscape/鹽埔5.jpg" alt="Yanpu5" /></a>
						<img class="thumb" src="images/indexlandscape/鹽埔5.jpg" />
						<span class="title">香甜好吃的屏東蓮霧</span>
						<span class="desc">現正優惠中</span>
					</li>
					<li>
						<img class="main" src="http://img.youtube.com/vi/_ZAvemTZKeo/0.jpg" />
						<img class="thumb" src="http://img.youtube.com/vi/_ZAvemTZKeo/2.jpg" />
						<span class="ervideo" data-erConfig="{src:'http://www.youtube.com/watch?v=_ZAvemTZKeo&amp;feature=youtu.be', autoplay:false}" style="display:none;"></span>
						<span class="desc">歡迎欣賞鹽埔觀光短片</span>
					</li>-->
					</ul>
				</div>
			<div data-ertype="layout" data-ertemplateName="NONE" style="">
				<div class="erimgMain" style="position: absolute; left:0px;right:0;top:11px;bottom:0;" data-erConfig="{___numTiles:3, scaleMode:'fillArea', duration:800, imgType:'main', alwaysPreviousButton:true, __loopNextButton:false, __arrowButtonMode:'rollover'}">
					<div class="erimgMain_slides" style="position: absolute; left:0; top:0; bottom:0; right:0;">
						<div class="erimgMain_slide">
							<div class="erimgMain_img" style="position: absolute; left: 0; right: 0; top:0;bottom:0;"></div>
							<div class="" style="position: absolute; left:0; right:0; bottom: 20px; padding: 7px 200px 7px 20px; background: #000; background:rgba(0,0,0,0.9); color: #FFF; font-family: Georgia, 'Times New Roman', Times, _serif; text-align: left;">
							<p class="erimgMain_desc" style="padding: 0; margin: 0; font: 12px/16px Arial,_sans; color: #FFF;"></p>
							</div>
						</div>
					</div>
						<!-- <div class="erimgMain_arrowLeft" style="position:absolute; left: 10px; top: 50%; margin-top: -15px;" data-erConfig="{image:'circleSmall', image2:'circleSmall'}"></div>
						<div class="erimgMain_arrowRight" style="position:absolute; right: 10px; top: 50%; margin-top: -15px;"></div> -->
				</div>
					<div class="erdots" style="overflow: hidden; margin: 0; font-size: 10px; font-family: 'Lucida Grande', 'Lucida Sans', Arial, _sans; color: #FFF; position: absolute; right:6px; bottom:30px; width:200px;" data-erConfig="{showText:false}" align="center">
						<div class="erdots_wrap" style="wasbackground-color: #CFC; float: right;" align="left"> <!-- modify the float on this element to make left/right/none=center aligned. -->
							<span class="erdots_btn_selected" style="padding-left: 0; width: 21px; height: 20px; display: inline-block; text-align: center; vertical-align: middle; line-height: 20px; margin: 0 2px 0 0; cursor: default; background: url(http://easyrotator.s3.amazonaws.com/1/i/rotator/dots/export/20_14_wite_65.png) top left no-repeat;">
								&nbsp;
							</span>
							<span class="erdots_btn_normal" style="padding-left: 0; width: 21px; height: 20px; display: inline-block; text-align: center; vertical-align: middle; line-height: 20px; margin: 0 2px 0 0; cursor: pointer; background: url(http://easyrotator.s3.amazonaws.com/1/i/rotator/dots/export/20_14_wite_35.png) top left no-repeat;">
								&nbsp;
							</span>
							<span class="erdots_btn_hover" style="padding-left: 0; width: 21px; height: 20px; display: inline-block; text-align: center; vertical-align: middle; line-height: 20px; margin: 0 2px 0 0; cursor: pointer; background: url(http://easyrotator.s3.amazonaws.com/1/i/rotator/dots/export/20_14_wite_65.png) top left no-repeat;">
								&nbsp;
							</span>
						</div>
					</div><div class="erabout erFixCSS3" style="color: #FFF; text-align: left; background: #000; background:rgba(0,0,0,0.93); border: 2px solid #FFF; padding: 20px; font: normal 11px/14px Verdana,_sans; width: 300px; border-radius: 10px; display:none;">
					This <a style="color:#FFF;" href="http://www.dwuser.com/easyrotator/" target="_blank">jQuery slider</a> was created with the free <a style="color:#FFF;" href="http://www.dwuser.com/easyrotator/" target="_blank">EasyRotator</a> software from DWUser.com.
					<br /><br />
					Use WordPress? The free <a style="color:#FFF;" href="http://www.dwuser.com/easyrotator/wordpress/" target="_blank">EasyRotator for WordPress</a> plugin lets you create beautiful <a style="color:#FFF;" href="http://www.dwuser.com/easyrotator/wordpress/" target="_blank">WordPress sliders</a> in seconds.
					<br /><br />
					<a style="color:#FFF;" href="#" class="erabout_ok">OK</a>   
					</div>
					<noscript>
						Rotator powered by <a href="http://www.dwuser.com/easyrotator/">EasyRotator</a>, a free and easy jQuery slider builder from DWUser.com.  Please enable JavaScript to view.
					</noscript>
					<script type="text/javascript">/*Avoid IE gzip bug*/(function(b,c,d){try{if(!b[d]){b[d]="temp";var a=c.createElement("script");a.type="text/javascript";a.src="http://easyrotator.s3.amazonaws.com/1/js/nozip/easy_rotator.min.js";c.getElementsByTagName("head")[0].appendChild(a)}}catch(e){alert("EasyRotator fail; contact support.")}})(window,document,"er_$144");</script>
			
				</div>
			</div><!-- End DWUser_EasyRotator -->
			<div>
				<img src="images/首頁下左.jpg" width="365" height="200" align="left" style="margin: 5px 0 0 18px;"/>
				<a href="showproduct.php?cid=1"><img style="clear:both; margin: 0 0 0 18px;" src="images/首頁下右上.jpg" width="182" height="130" align="left" /></a>
				<a href="showproduct.php?cid=2"><img src="images/首頁下右下.jpg" width="183" height="130" align="left" /></a>
			</div>
			<iframe width="300" height="250" src="//www.youtube.com/embed/_ZAvemTZKeo?rel=0" frameborder="0" allowfullscreen style="margin-top: 50px;"></iframe>
		</div>
	</div>
</div>
	<div id="Footer"><br>Copyright© 2013 張家蜜棗版權所有<br>國立中央大學資管系第103級專題小組開發</div>
</div>
</body>
</html>
