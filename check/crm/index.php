<?php if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Job History of <em class="partner"></em></title>
		<meta name="description" content="Sticky Table Headers Revisited: Creating functional and flexible sticky table headers" />
		<meta name="keywords" content="Sticky Table Headers Revisited" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		

	</head>
	<body>
		<center id="loading"><div ><img src="loading.gif"</div></center>
		<div class="container">
		
			<header>
				<h1>Job History of <em class="partner"></em> <span class="count">จำนวนทั้งหมด  งาน : เป็นเงินทั้งหมด บาท</span></h1>	
				<!--
				<nav class="codrops-demos">
					<a href="../stat/2013/check/new.php" title="Basic Usage">&lt;back</a>
					
					<a class="current-demo"  href="#" title="Wide Tables">TAX ID: <input type="text" id="tax_id" /></a>
				</nav>
				-->
			</header>

			<div class="component">
				<table id="history" class="overflow-y">
					<thead>
						<tr>
							<th>JOB NO.</th><th>ชื่องาน</th><th>จำนวน</th><th>ต่อหน่วย</th><th>ราคารวม</th><th>กระดาษ</th><th>สี</th><th>หลังพิมพ์</th><th>ช่างอาร์ต</th><th>เครื่องพิมพ์</th><th>ช่างพิมพ์</th><th>ประสานงาน</th><th width="130">วันที่ส่งงาน</th>
						</tr>
					</thead>
					<tbody>
						<!--
						<tr>
							<th>Sample #4</th><td>10</td><td class="err">Parse error</td><td>32</td><td>45</td><td>53</td><td>29</td><td>35</td><td>35</td><td>75</td><td>9</td><td>69</td><td>66</td><td>93</td><td>42</td><td>81</td><td>85</td><td>72</td><td>70</td><td>15</td><td>38</td>
						</tr>
							-->
						
					</tbody>
				</table>
					<!--
				<p class="filler">eu, magna. Suspendisse facilisis gravida, nisl pellentesque sagittis vel, accumsan fringilla orci. Ut rhoncus dolor ac nibh ut justo. Vivamus faucibus vestibulum. Nunc ut venenatis nulla.</p>
				-->
			</div>

		</div><!-- /container -->
		<script src="../../js/jquery-1.7.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
		<script src="js/jquery.stickyheader.js"></script>
		<script type="text/javascript" src="../../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="../../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="../../fancybox/jquery.fancybox-1.3.4.css" media="screen" />

		<script>
		$('.container').hide();
		$("body").css("background","#fff");
		$(function(){
			var p = <?php echo "'".$pid."'";
    ?>;
			$.ajax({
                url:'../../ajax/_partner_detail.php',
                type: 'GET',
                data: {
                    pid: p
                },
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                beforeSend: function() {
				    $('.container').hide();
				    $("#loading").show();
				  },
                success: function(data) {
                	$("body").css("background","#f8f8f8");
                	$("#loading").hide();
                	$('.container').show();
               		var c = 0;
               		var m = 0;
               		var tax_id = data[0][17];
               		$("#tax_id").val(tax_id);
               		console.log(data[0][17]);
					$.each(data,function(k,v) {
						$.each(v,function(k1,v1){
							v1 = v1 || "-";
							v[k1] = v1;
							if(v[15] == "-")
								v[15] = "กำลังดำเนินการ";

						});
						
						$("#history tbody").append("<tr><th>"+v[2]+"</th><td>"+v[1]+" <a class='fancybox' target='_blank' href='http://101.109.254.13/stat/2013/check/cchat.php?job_no="+v[2]+"'><img src='paper.gif'/></a></td><td>"+v[3]+"</td><td>"+v[4]+"</td><td>"+v[5]+"</td><td>"+v[6]+"</td><td>"+v[7]+"</td><td>"+v[9]+"</td><td>"+v[10]+"</td><td>"+v[11]+"</td><td>"+v[12]+"</td><td>"+v[13]+"</td><td class='err'>"+v[15]+"</td></tr>");
						
						$(".fancybox").fancybox({
				'width'	: 800,
				'height'	: 380,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
'type'				: 'iframe',
			});

						$(".partner").html(v[0]);
						c++;
						if(v[4] != "-") {
							m = m + parseInt(v[5]);
						}


					});
					m = m.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
					$(".count").html("จำนวนทั้งหมด "+c+" งาน : เป็นเงินทั้งหมด "+m+" บาท")
					init();
				}
			});
		});
		</script>
	</body>
</html>
<?php 
} ?>