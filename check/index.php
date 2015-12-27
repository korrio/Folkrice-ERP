<!DOCTYPE html>
<html lang="en">
<head>
<title>Folkrice :: Order Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/jquery-1.7.min.js"></script>
	<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-theme.css" rel="stylesheet">
<script src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script>
$(function(){
	call('','','','','');
	$('body').clearQueue();
		$("[name='job']").keyup(function(event){
    if(event.keyCode == 13){
        $("#get_check").click();
    }
});
$("[name='partner']").keyup(function(event){
    if(event.keyCode == 13){
        $("#get_partner").click();
    }
});
$("[name='tax_id']").keyup(function(event){
    if(event.keyCode == 13){
        $("#get_crm").click();
    }
});
$("#get_crm").click(function(){
		var tax_id = $("[name='tax_id']").val(); 
		checkTax(tax_id);
	});

	function checkTax(tax_id){
		$.ajax({
                url:'_check_tax.php',
                type: 'GET',
                data: {
					tax_id: tax_id
                },
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                success: function(data) {
					var a = data;
                	//console.log(data[0].ref);
					if(a[0] == null) {
						alert("ไม่มีรหัสประจำตัวผู้เสียภาษี หรือ ยังไม่มีข้อมูลบริษัทของท่าน");
					} else {
						var url = "/stat/2013/check/crm/index.php?pid="+data[0].id;
						$("#display").html("");
						$("#display").append('<iframe frameborder="0" id="check" class="bar" style=" min-height: 100%; " width="100%" type="text/html" src="'+url+'"></iframe>')
						//window.open("/stat/2013/check/crm/index.php?pid="+data[0].id,"_blank");
						//alert(data[0].id + " : " + data[0].name);
					}
                }
		});
    };
	
	function call(j,s,st,h,p){
		$.ajax({
                url:'_icheck.php',
                type: 'GET',
                data: {
                    job_no: j,
                    state: s,
                    stage: st,
                    holder: h,
		    partner: p
                },
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                success: function(data) {
                	var c = 0;
			      	var table='<table class="stbl" cellspacing="0">';
			      	/* loop over each object in the array to create rows*/
			      	table += "<tr><th class='first'>Order No.</th><th class='second'>ลูกค้า</th><th>รับคำสั่งซื้อ</th><th>นัดรับของ</th><th>ผู้รับคำสั่งซื้อปัจจุบัน</th><th>การตรวจสอบ</th><th>สถานะของ</th><th class='last'>ความคืบหน้า</th></tr>";
			      	$.each(data, function(index, item){
					var myjobno;
			      		if(item.fax == null) {
			      			job_name = "";
						
			      		} else {
			      			job_name = item.fax;
						
			      		}

					if(job_name == "") {
						var i = item.job_no;
						var a =	i.split(" ");
						myjobno = a[0];
					} else {
						myjobno = item.job_no;
	}

	date_open = item.date_open;
	date_open = date_open.substr(0,10);
	if(typeof item.date_deadline !== 'undefined' && item.date_deadline !== null) {

		var oneDay = 86400000;


		var today = new Date();
		var dead = new Date(item.date_deadline);
console.log((dead - today)/oneDay );
if((dead - today) <= (oneDay)) {
	late_str = '<br><span class="label label-success">due</span>';
} else if((dead - today) < (oneDay * 3)) {
	late_str = '<br><span class="label label-warning">warn</span>';
} else {
	late_str = '';
}

	date_deadline = item.date_deadline;
	date_deadline = date_deadline.substr(0,10);
	late = (today > dead) ? "late" : "";
	late_str = (today > dead) ? '<br><span class="label label-danger">late !</span>' : late_str;
} else {
	date_deadline = "-";
	late = "";
	late_str = "";
}

			      	 	table+='<tr><td style="text-align:center"><a class="fancybox" href="cchat.php?job_no=' + myjobno + '">'+item.job_no + " " + 
			      	 	'</a></td><td class="partner second">'+item.p_name+'</td><td style="width:100px">'+date_open+'</td><td style="width:100px" class="'+late+'">'+date_deadline+late_str+'</td><td class="stakeholder">'+item.login+'</td><td class="state">'+
			      	 	item.state+'</td><td>'+item.s_name+'</td><td>'+
			      	 	'<div class="progress progress-striped active"> <div class="progress-bar"  role="progressbar" aria-valuenow="'+item.probability+'" aria-valuemin="0" aria-valuemax="100" style="width: '+item.probability+'%">' +
   '<span class="sr-only">'+item.probability+'%</span></div></div>'+item.probability+'%</td></tr>';   
			      	 	c++;    

			      	});
			      	table+='</table>';
					/* insert the html string*/
			      	$("#display").html( table );	
			      	$(".total").html(c);
$(".fancybox").fancybox({
	'width' : 800,
	'height' : 400,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
'type'				: 'iframe',
			});
			      	$("table tr:nth-child(odd)").addClass("odd-row");
					/* For cell text alignment */
					$("table td:first-child, table th:first-child").addClass("first");
					/* For removing the last border */
					$("table td:last-child, table th:last-child").addClass("last");	

				}
		});
	}
	function call_holders(){
		$.ajax({
                url:'_holders.php',
                type: 'GET',
                data: {

                },
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                success: function(data) {
                	$.each(data, function(index, item){
                		var opt_holder = "<option value='" + item.login + "'>" + item.login + " (" + item.name + ")" + "</option>";
                		$("[name='holder']").append(opt_holder);
                	});                	
                }
		});
    };
    function call_stages(){
		$.ajax({
                url:'_stages.php',
                type: 'GET',
                data: {

                },
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                success: function(data) {
                	$.each(data, function(index, item){
                		var opt_stages = "<option value='" + item.id + "'>" + item.name + " (" + item.probability + "%)" + "</option>";
                		$("[name='stage']").append(opt_stages);
                	});                	
                }
		});
    };
	$("#get_check").click(function(){
		var j = $("[name='job']").val();
		var s = "";
		var st = "";
		var h = "";
		var p = "";
		call(j,s,st,h,p);
	});
	$("#get_state").change(function(){
		var j = "";
		var s = $(this).val();
		var st = "";
		var h = "";
var p = "";
		call(j,s,st,h,p);
	});
	$("#get_holder").change(function(){
		var j = "";
		var s = "";
		var st = "";
		var h = $(this).val();
var p = "";
		call(j,s,st,h,p);
	});
	$("#get_stage").change(function(){
		var j = "";
		var s = "";
		var st = $(this).val();
		var h = "";
var p = "";
		call(j,s,st,h,p);

	});
	$("#get_all").click(function(){
		var j = "";
		var s = "";
		var st = "";
		var h = "";
var p = "";
		call(j,s,st,h,p);
	});
	$("#get_partner").click(function(){
		var j = "";
		var s = "";
		var st = "";
		var h = "";
		var p = $("[name='partner']").val();
		call(j,s,st,h,p);
	});
	/* default call */

	call_holders();
	call_stages();

		/* For zebra striping */
        
});
</script>
<style>
body {
	-webkit-box-shadow: 1px 1px 10px rgba(0, 0, 0, .25);
-moz-box-shadow: 1px 1px 10px rgba(0, 0, 0, .25);
box-shadow: 1px 1px 10px rgba(0, 0, 0, .25);
background: #fff;
border-radius: 10px;
}
.late {
	color:red;
}
.right {
clear:both;
}
#uptotop {
	padding: 20px;
background: #ddd;
opacity: 0.6;
right: 10px;
bottom: 10px;
position: fixed;
width: 65px;
}
body .stbl td {
	padding: 5px 10px
}
</style>

<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body onload="">

	<div>
	<div style="padding: 10px;">
	<!-- <div class="right" style="">
			<h4 style="text-align:right">สำหรับเช็คคำสั่งซื้อ <br/>(For order check)<br/></h4>
			<label for="job">Tax ID</label>
			<input type="text" name="tax_id" style="" placeholder="0843534000873"/>
			<button type="button" class="btn btn-xs btn-success"  id="get_crm" >Check</button>
		</div>	 -->

		<div class="right">
		<h4 style="text-align:right">สำหรับเช็คคำสั่งซื้อ <br/>(For order check)<br/></h4>
			<label for="job">Customer</label>
			<input type="text" name="partner" style=""/>
			<button type="button" class="btn btn-xs btn-success"  id="get_partner" >Check</button>
		</div>
		<div class="right">
			<label for="job">Order# </label>
			<input type="text" name="job" style=""/>
			<button type="button" class="btn btn-xs btn-success"  id="get_check" >Check</button>
			
		</div>
		<div class="right">
			<table border='0' style="margin-bottom: 20px;">
				<tr>
				<td>
				<label for="stage">ขั้นตอน:</label><br/>
				<select id="get_stage" name='stage'>				

				</select><span> | </span>
				</td>
				<td>
				<!--
				<label for="state">State:</label><br/>
				
				<select id="get_state" name='state'>				
					<option>draft</option>
					<option>open</option>				
					<option>done</option>
					<option>cancel</option>
				</select><span> | </span>
				-->
				</td>
				<td>
				<label for="holder">ข้าวของ:</label><br/>
				<select id="get_holder" name='holder'>				

				</select>
				</td>
				</tr>
				<tr><td></td><td></td><td></td></tr>
			</table>
		</div>
	<div id="head">
	<!-- <a target="_blank" href="http://www.folkrice.com">
	<img width="80" src="http://www.folkrice.com:3000/assets/images/logo.png" /></a>  -->

	<h2>สถิติ Order ในระบบ Online Agriculture</h2> เฉพาะคำสั่งซื้อแบบเปิดในระบบ <br></div>	
	<span id="sum" class="label label-info">จำนวน: <span class="total"></span><span class=" unit"> คำสั่งซื้อ</span></span>
		<br><br>
			<p><span class="label label-warning">warn</span> = เหลืออีก 3 วันนัดรับของ <span class="label label-success">due</span> = นัดรับของพรุ่งนี้ <span class="label label-danger">late !</span> = เลยกำหนดส่งของ</p>
	
	<div id="display">

	</div>

</div>
<a id="uptotop" data-role="button" class="ui-btn-right" data-icon="arrow-u" data-theme="a">Top</a>
<script type="text/javascript">
     $('#uptotop').live('click', function() {
           $('body').animate({scrollTop: '0px'}, 500, function(){ $('body').clearQueue(); });
     });
</script>


</body>
</html>
