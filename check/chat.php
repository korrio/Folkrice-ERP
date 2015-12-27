<!DOCTYPE html>
<html lang="en">
<head>
<title>Check status</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/jquery-1.7.min.js"></script>
<script src="../js/sprintf-0.7-beta1.js"></script>
<script>
$(function(){
	var job_no = <?  if(isset($_GET['job_no'])){echo ""+$_GET['job_no'];} else { echo "''";}; ?>;
	if(job_no != "") {
		$(".job_no").html("" + job_no);
		call(job_no);	
	}
	$('body').clearQueue();
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
				
			      	table += "<tr><th>ผู้เปลี่ยนสถานะงาน</th><th>เวลา</th><th>บันทึกการทำงาน</th></tr>";
			      	$.each(data, function(index, item){
					if(item.body_text == null && c == 0) {
						item.body_text = "เปิดงาน";
					}
			      	 	table+='<tr><td class="">'+item.user+'</td><td class="">'+item.create_date+'</td><td class="">'+item.body_text+'</td></tr>';   
			      	 	c++;    
			      	});
			      	table+='</table>';
					/* insert the html string*/
			      	$("#display").html( table );	
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
.right {
clear:both;
}
</style>

<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>

	<div style="padding: 10px;">
	<!--
<div>
		<div class="right">
			<label for="job">Job No</label><br/>
			<input type="text" name="job" style=""/>
			<input type="submit" value="Check" id="get_check" />
			
		</div>

	</div>
-->

	<div id="head"><h1>บันทึกการทำงาน </h1><br/>Job No:<br/><h1><span class="job_no"></span></h1>
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
