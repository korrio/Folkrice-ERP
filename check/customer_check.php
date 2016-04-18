<!DOCTYPE html>
<html lang="en">
<head>
<title>Check your job</title>
<script src="../js/jquery-1.7.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../dist/css/bootstrap.css" rel="stylesheet">
<link href="../../dist/css/bootstrap-theme.css" rel="stylesheet">
<link href="../css/flattbl.css" rel="stylesheet">
<script src="../../dist/js/bootstrap.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script>
$(function(){
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
	function call(j,s,st,h,p){
		$.ajax({
                url:'_ccheck.php',
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
                	if(data == null) 
                		console.log("some null");
                	var c = 0;
			      	var table='<table class="stbl" cellspacing="0">';
			      	/* loop over each object in the array to create rows*/
			      	//table += "<tr><th class='first'>Job No.</th><th class='second'>ลูกค้า</th><th>ผู้รับงานปัจจุบัน</th><th>การตรวจสอบ</th><th>สถานะงาน</th><th class='last'>ความคืบหน้า</th></tr>";
			      	table += "<tr><th class='first' width='200'>Job No.</th><th>วันรับงาน</th><th class='second'>ลูกค้า</th><th>สถานะงาน</th><th class='last'>ความคืบหน้า</th></tr>";
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
	//date_closed = item.date_closed;
	//date_closed = date_closed.substr(0,10);
			      	 	table+='<tr><td><a class="fancybox" href="cchat.php?job_no=' + myjobno + '">'+
			      	 	item.job_no + " " + job_name + '</a></td><td>'+date_open+'</td><td class="partner second">'+item.p_name+
			      	 	//'</td><td class="stakeholder">'+	item.login+'</td><td class="state">'+item.state+
			      	 	'</td><td>'+item.s_name+'</td><td><div class="progress">'+
        '<div class="progress-bar" role="progressbar" aria-valuenow="'+item.probability+'" aria-valuemin="0" style="width:'+item.probability+'%" aria-valuemax="100">'+
        '<span class="sr-only">'+item.probability+'% Complete</span></div>'+
      '</div>'+item.probability+'%</td></tr>';   
			      	 	c++;    

			      	});
			      	table+='</table>';
					/* insert the html string*/
			      	$("#display").html( table );	
			      	$(".total").html(c);
$(".fancybox").fancybox({
				'width'	: 800,
				'height'	: 450,
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
	//var j = <?php echo "'".$_GET['job_no']."'"; ?>;
	/* default call */

	call_holders();
	call_stages();

		/* For zebra striping */
        
});
</script>
<style type="text/css">
body {background:none transparent;
}

#display {
clear:both;
}
.right {
	margin: 0 10px;
}
#check_head {
	position: fixed;
background: #fff;
width: 101%;
margin-left: -10px;
box-shadow: 1px 3px 15px #eee;
margin-top: -10px;
height: 120px;
padding: 10px;
}

body table.stbl {
	margin-top: 130px;
}
</style>

<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>


<div style="padding:10px">
	<div id="check_head">
		<a target="_blank" href="http://www.samuiaksorn.com" rel="Back Home" title="Back Home">
		<img src="http://www.samuiaksorn.com/wp-content/uploads/2014/01/Aksorn_Logo_PNG.png" style="float:left;margin-bottom:10px"/>
		</a>
		<div class="right" >

			
			<label for="job">Customer</label><br/>
			<input type="text" name="partner" style="" placeholder="โรงแรมสมุย"/>
			<button type="button" class="btn btn-xs btn-success"  id="get_partner" >Check</button>
			<br/><span id="sum" class="label label-info">ทั้งหมด: <span class="total"></span><span class=" unit"> งาน</span></span>
		</div>
		<div class="right" style="margin-bottom: 30px;">
			<label for="job">Job No</label><br/>
			<input type="text" name="job" style="" placeholder="12345"/>
			<button type="button" class="btn btn-xs btn-success"  id="get_check" >Check</button>
			<span> OR </span>
		</div>	

	</div>	

	<div id="display">

	</div>

</div>
<script type="text/javascript">
     $('#uptotop').live('click', function() {
           $('body').animate({scrollTop: '0px'}, 500, function(){ $('body').clearQueue(); });
     });
</script>


</body>
</html>
