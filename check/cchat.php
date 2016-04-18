<!DOCTYPE html>
<html lang="en">
<head>
<title>Order detail</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/jquery-1.7.min.js"></script>
<script src="../js/sprintf-0.7-beta1.js"></script>
<script>
$(function(){
	var job_no = <?php  if (isset($_GET['job_no'])) {
     echo '' + $_GET['job_no'];
 } else {
     echo "''";
 } ?>;
	if(job_no != "") {
		var myjob = "" + sprintf( "%05d", job_no );
		$(".job_no").html("" + job_no);
		$(".myjob").html("" + job_no);
		$(".job-no").val("" + myjob);
		call(job_no);	
	}
	$('body').clearQueue();
	
$(".job-submit").click(function(e){e.preventDefault();
var j = sprintf( "%05d", $(".job-no").val() );
	window.location.assign("cchat.php?job_no="+j);
});

	$("#sendm").click(function(){
		var m = $("[name='message']").val();
		var j = job_no;
		j = sprintf( "%05d", job_no );
		$.ajax({
		        url:'_insert.php',
		        type: 'GET',
		        data: {
		            job_no: j,
			    message: m
		        },
		        dataType: 'jsonp',
		        dataCharset: 'jsonp',
		        success: function(data) {

			},
			complete: function(){
				alert("ได้รับบันทึกงานแล้วค่ะ");
				call(j);
				$("html, body").animate({ scrollTop: $(document).height() }, "slow");
			}
		});

		var subject = "คำสั่งซื้อข้าวพื้นเมือง " + j;
		var samui_email = "folkrice.th@gmail.com";
		var message = "ข้อความจากลูกค้า: " + m;

		$.ajax({
		        url:'http://erp.samuiaksorn.com/send_email.php?to='+samui_email+'&subject='+subject+'&message='+message,
		        type: 'GET',
		        dataType: 'jsonp',
		        dataCharset: 'jsonp',
		        success: function(data) {

			},
			complete: function(){
			
			}
		});
	})

	function call(j){
		$.ajax({
                url:'_chat.php',
                type: 'GET',
                data: {
                    job_no: j,
                },
                dataType: 'jsonp',
                dataCharset: 'jsonp',
                success: function(data) {
                	var c = 0;
			      	var table='<table class="stbl" cellspacing="0">';
							var i = 0;
							var total_price = 0;
							var when;
							var order_id;
			      	table += "<tr><th>ลำดับที่</th><th>ผู้ผลิต</th><th>รายการสินค้า</th><th>จำนวน</th><th>ราคา</th></tr>";
			      	$.each(data, function(index, item){
					if(item.body_text == null && c == 0) {
						item.body_text = "เปิดงาน";
					}
						if(item.body_text != null) {
								when = item.create_date;
								order_id = item.order_id;
								i++;
								total_price += parseFloat(item.price);
			      	 	table+='<tr><td style="text-align:center">'+i+'</td><td class="">'+item.body_text+'</td><td class="">'+item.user+'</td><td>'+item.quantity+'</td><td>'+item.price+'</td></tr>';   
			      	 	c++;  
			      	 	}  
			      	});
			      	table += '<tr><td colspan=3></td><td>รวม</td><td>'+total_price+'</td></tr>';
			      	table+='</table>';
					/* insert the html string*/
			      	$("#display").html( table );	
			      	$(".total").html(c);
			      	$(".when").html(when);
			      	$(".order_no").html(order_id);

			      	$("table tr:nth-child(odd)").addClass("odd-row");
					/* For cell text alignment */
					$("table td:first-child, table th:first-child").addClass("first");
					/* For removing the last border */
					$("table td:last-child, table th:last-child").addClass("last");	

				}
		});
	}

	$("#get_check").click(function(){
		var j = $("[name='job']").val();
		call(j);
		$(".job_no").html("" +sprintf( "%05d", j ));
	});
	
        
});
</script>
<style>
.right {
clear:both;
float:right;
}
</style>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-theme.css" rel="stylesheet">
<script src="../js/bootstrap.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
   
    <a class="navbar-brand" href="#"><h4>Order detail / รายละเอียดการสั่งซื้อ</h4>
    <!--<p>Order# <span class="order_no"></span>  <br/>
    <p>วันที่ <span class="when"></span> <br/></p>-->
    </a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <form class="navbar-form navbar-right" action="" role="search">
      <div class="form-group">
        <input type="text" class="form-control job-no" placeholder="Search Job No.">
      </div>
      <button type="submit" class="btn btn-default job-submit">Submit</button>
    </form>
   
  </div><!-- /.navbar-collapse -->
</nav>

<div id="display" style="clear:both">
<img src="" />
	</div>

	<div style="display:none;padding: 10px;">


<div style="float: left;
margin: 20px 0;
width: 100%;clear:both">
<textarea class="form-control" rows="3" name="message" id="message" cols="40" placeholder="Leave your comment here / ลูกค้าใส่รายละเอียดงานเพิ่มเติมได้ที่นี่" rows="4"></textarea><BR>
<input id="job_no" name="job_no" type="hidden" value="">
<p><a href="#" class="btn btn-primary btn-lg right" role="button" id="sendm">Send</a></p>
</div>

	
	
</div>

<script type="text/javascript">
     $('#uptotop').live('click', function() {
           $('body').animate({scrollTop: '0px'}, 500, function(){ $('body').clearQueue(); });
     });
</script>


</body>
</html>
