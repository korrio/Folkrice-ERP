<meta charset="utf-8">
<script src="js/jquery-1.7.min.js"></script>
<script>
	var mn = Array("","January","February","March","April","May","June","July","August","September","October","November","December");
	function name_to_nmonth(mn,name) {
		var n;
			$.each(mn,function(k,v) {
				//console.log(v == name);
				if(v == name) {
					n = k;
				}

			});
			return n;
		}
	$(function(){

		$.ajax({
	        url: 'ajax/_get_month.php',
	        type: 'GET',
	        dataType: 'jsonp',
	        dataCharset: 'jsonp',
	        success: function (data) {
	        	$.each(data,function(k,v){
	        		var n = name_to_nmonth(mn,v[0]);
	        		if(n != 0)
	        			var s = "<option value='" + n + "," + v[1] + "'>" + v[0] + " (" + v[1] + ")" + "</option>";
	        		$("[name='months']").append(s);
	        	})
	        }
    	});
		$("[name='mno']").val("8");
    	$("[name='months']").change(function(){
    		$("[name='mno']").val($(this).val());
    	});
	});
</script>
<label for="months">เลือกเดือนเพื่อ Export ข้อมูล <img src="images/icon_excel.png" title="export excel file" width="18"></label><br/>
<select name="months">
</select>
<form id="genexcel" target="_blank" method="POST" style="display:inline-block;" action="ajax/_report.php">
<input name="mno" type="hidden" />
<button href="#" id="excel" class="btn btn-small"> Export</button>
</form>
