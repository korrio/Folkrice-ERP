<!DOCTYPE html>
<html lang="en">
<head>
<title>Check status</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/jquery-1.7.min.js"></script>
<script src="../js/sprintf-0.7-beta1.js"></script>
<script type="text/javascript" src="sortable/jquery.tablesorter.min.js"></script> 

<link rel="" href="sortable/themes/blue/style.css" />
<script>
$(function(){
	var job_no = <?php  if (isset($_GET['job_no'])) {
     echo '' + $_GET['job_no'];
 } else {
     echo "''";
 } ?>;
	if(job_no != "") {
		var myjob = "" + job_no;
		$(".job_no").html("" + job_no);
		$(".myjob").html("" + job_no);
		$(".job-no").val("" + myjob);
		call(job_no);	
	}
	$('body').clearQueue();
	
$(".job-submit").click(function(e){e.preventDefault();
	var j = sprintf( "%05d", $(".job-no").val() );
	window.location.assign("ochat.php?job_no="+j);
});

	$("#sendm").click(function(){
		var m = $("[name='message']").val();
		var j = job_no;
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

		var subject = "(ERP) บันทึกการทำงาน Job No. " + j;
		var samui_email = "samuiaksorn@hotmail.com";
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

                	j = sprintf( "%05d", j );
                	var c = 0;
			      	var table='<table id="mytable" class="tablesorter stbl" cellspacing="0">';
				
			      	table += "<tr><th>ผู้กรอก</th><th>เวลา</th><th>บันทึกการทำงาน Job NO: "+j+"</th></tr>";
			      	$.each(data, function(index, item){
					if(item.body_text == null && c == 0) {
						item.body_text = "เปิดงาน";
					}
						if(item.body_text != null) {
			      	 	table+='<tr><td class="tmid small">'+item.user+'</td><td class="tleft small">'+item.create_date+'</td><td class="tleft">'+item.body_text+'</td></tr>';   
			      	 	c++;  
			      	 	}  
			      	});
			      	table+='</table>';
					/* insert the html string*/
			      	$("#display").html( table );	

$(".tablesorter").tablesorter({ 
        // sort on the first column and third column, order asc 
        widthFixed: true, 
        widgets: ['zebra'],
		 theme : 'blue',
		    sortInitialOrder: "desc",


    dateFormat : "ddmmyyyy", // set the default date format

    // or to change the format for specific columns, add the dateFormat to the headers option:
    headers: {
      1: { sorter: "shortDate",sortInitialOrder: 'desc' } //, dateFormat will parsed as the default above
      // 1: { sorter: "shortDate", dateFormat: "ddmmyyyy" }, // set day first format; set using class names
      // 2: { sorter: "shortDate", dateFormat: "yyyymmdd" }  // set year first format; set using data attributes (jQuery data)
    }

    });


			      	$(".total").html(c);
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
		$(".job_no").html("" + j);
	});
	 
	
        
});
</script>
<style>
html body .stbl {
	margin-top:0;
	margin:0px;
}
body .stbl .small {
	width:100px;
}
body .stbl .tmid {
	text-align:center;
}
body .stbl .tleft {
	text-align:left;
}
body .stbl th,body .stbl td {
	padding:3px;
}
.right {
clear:both;
float:right;
}
</style>
<link href="../../dist/css/bootstrap.css" rel="stylesheet">
<link href="../../dist/css/bootstrap-theme.css" rel="stylesheet">
<script src="../../dist/js/bootstrap.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div id="display" style="clear:both">

	</div>

	<div style="padding: 10px;">




	
	
</div>

<script type="text/javascript">
     $('#uptotop').live('click', function() {
           $('body').animate({scrollTop: '0px'}, 500, function(){ $('body').clearQueue(); });
     });
</script>


</body>
</html>
