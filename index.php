<!doctype html>  
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		
		<title>Folkrice - Executive Summary</title>

		<meta name="viewport" content="minimum-scale=1.0; maximum-scale=1.0; user-scalable=no; initial-scale=1.0;"/>

		<meta name="description" content="Excutive Summary for Folkricers">
		<meta name="author" content="Folkricers">
		
		<link rel="stylesheet" href="css/demo.css">
		<!-- CSS Files -->
		<link type="text/css" href="css/base2.css" rel="stylesheet" />
		<link type="text/css" href="css/BarChart.css" rel="stylesheet" />

		<!--[if IE]><script language="javascript" type="text/javascript" src="../../Extras/excanvas.js"></script><![endif]-->

		<!-- JIT Library File -->
		<script language="javascript" type="text/javascript" src="js/jit.js"></script>

		
		<script language="javascript" type="text/javascript" src="example3.js"></script>
		<script src="js/jquery-1.7.min"></script>
		<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-theme.css" rel="stylesheet">
<script src="js/bootstrap.js"></script>
		
		<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	
		<script>
			$(function(){
				$(".bar").css("-webkit-overflow-scrolling","touch");
				$(".smenu li a").click(function(){
					var href = $(this).attr("href");
					switch(href) {
						case "#order":
							$(".bar").hide();
							$("#order").show();
							meny.close();
						break;
						case "#product":
							$(".bar").hide();
							$("#product").show();
							meny.close();
						break;
						case "#form":
							$(".bar").hide();
							$("#form").show();
							meny.close();
						break;
						case "#farm":
							$(".bar").hide();
							$("#farm").show();
							meny.close();
						break;
						
						default:

						break;
					} 
				});
			});
		</script>
		<style>
		iframe {
			margin-left: -35px;
margin-top: -20px;
position:absolute; left: 0; right: 0; bottom: 0; top: 0px; 
		}
		.smenu li a {
			color: #fff;
		}
		</style>
	</head>
	
	<body onload="init();">

		<div class="meny" style="background-color:#336600">
			<h2><img src="http://www.folkrice.com:3000/assets/images/logo.png" /></h2>
			<h2>Folkrice 2016</h2>
			<h4>Executive Summary</h4>


			<ul class="smenu">	
				<h2>Order</h2>
				<li><a href="#order">จัดการคำสั่งซื้อ</a></li>		
				<!--<li><a href="#status">งานแต่ละแผนก (Status)</a></li>-->
				<h2>Product</h2>
				<li><a href="#product">สินค้า (ข้าว)</a></li>
				<h2>Open Data</h2>
				<li><a href="#form">กรอกข้อมูล (Form)</a></li>
				<li><a href="#farm">Folk Chat (Farm)</a></li>
				
			</ul>
		</div>

		<div class="meny-arrow"></div>

		<div class="contents">
			
			<!--
			<iframe id="bar" src="bar/type.html" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:1000px; height:600px; position: relative; top: 4px;" allowTransparency="true"></iframe> -->
			<article>
				<div id="container">
					<iframe id="form" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="http://form.folkrice.com" style="display:none"></iframe>
					
					<iframe id="order" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="http://erp.folkrice.com/check/index.php" style=""></iframe>
					<iframe id="product" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="http://api.folkrice.com" style=""></iframe>
					
					<iframe id="farm" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="http://farm.folkrice.com" style="display:none"></iframe>
					<!-- <iframe id="type" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="type.php" style="display:none"></iframe>
					<iframe id="channel" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="channel.php" style="display:none"></iframe>
					<iframe id="state" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="state.php" style="display:none"></iframe>
					<iframe id="report" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="report.php" style="display:none"></iframe>
<iframe id="client" class="bar" height="100%" width="100%" frameborder="0" type="text/html" src="client.php" style="display:none"></iframe> -->

				</div>

				<!--
				<h1>Meny</h1>
				<p>
					A three dimensional and space efficient menu.
				</p>
				<p>
					Move your mouse towards the arrow &mdash; or swipe in from the arrow if you're on a touch device &mdash; to open.
					Test it with any page by appending a URL, like so: <a href="http://lab.hakim.se/meny/?u=http://hakim.se">lab.hakim.se/meny/?u=http://hakim.se.</a> 
				</p>
				<p>
					Meny can be positioned on any side of the screen: <br>
					 <a href="http://lab.hakim.se/meny/?p=top">top</a> 
					 - <a href="http://lab.hakim.se/meny/?p=right">right</a> 
					 - <a href="http://lab.hakim.se/meny/?p=bottom">bottom</a>
					 - <a href="http://lab.hakim.se/meny/?p=left">left</a> 
				</p>
				<p>
					Instructions and download at <a href="http://github.com/hakimel/meny">github.com/hakimel/meny</a>.
				</p>
				<p>
					The name, <em>Meny</em>, is swedish.
				</p>
				<small>
					Created by <a href="http://twitter.com/hakimel">@hakimel</a> / <a href="http://hakim.se/">http://hakim.se</a>
				</small>
			-->
			</article>

			<div class="sharing">
				<!--
				<a href="http://twitter.com/share" class="twitter-share-button" data-text="Meny - a three dimensional and space efficient menu concept by @hakimel" data-url="http://lab.hakim.se/meny" data-count="small" data-related="hakimel"></a>
				
				<iframe id="facebook-button" src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Flab.hakim.se%2Fmeny%2F&layout=button_count&show_faces=false&width=83&action=like&font=arial&colorscheme=light&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:24px; position: relative; top: 4px;" allowTransparency="true"></iframe> 
			-->
			</div>
			
		</div>

		<script src="js/meny.min.js"></script>
		<script>
			// Create an instance of Meny
			var meny = Meny.create({
				// The element that will be animated in from off screen
				menuElement: document.querySelector( '.meny' ),

				// The contents that gets pushed aside while Meny is active
				contentsElement: document.querySelector( '.contents' ),

				// [optional] The alignment of the menu (top/right/bottom/left)
				position: Meny.getQuery().p || 'left',

				// [optional] The height of the menu (when using top/bottom position)
				height: 200,

				// [optional] The width of the menu (when using left/right position)
				width: 260,

				// [optional] Distance from mouse (in pixels) when menu should open
				threshold: 40
			});

			// API Methods:
			// meny.open();
			// meny.close();
			// meny.isOpen();
			
			// Events:
			// meny.addEventListener( 'open', function(){ console.log( 'open' ); } );
			// meny.addEventListener( 'close', function(){ console.log( 'close' ); } );

			// Embed an iframe if a URL is passed in
			if( Meny.getQuery().u && Meny.getQuery().u.match( /^http/gi ) ) {
				var contents = document.querySelector( '.contents' );
				contents.style.padding = '10px';
				contents.innerHTML = '<div class="cover"></div><iframe src="'+ Meny.getQuery().u +'" style="width: 100%; height: 100%; border: 0; position: absolute;"></iframe>';
			}
		</script>

		
	</body>
</html>
