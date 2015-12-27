<?php
	include_once('_db_mysql.php');
	if ($dbh === null) {
		//Error
	} else {

		//$q = "SELECT * FROM res_users";
		$a = array("id"=>"79","name"=>"แอ็คชั่น","login"=>"Folkrice");
		$b = array("id"=>"80","name"=>"ชิน","login"=>"ชินโตะฟาร์ม");
		$c = array("id"=>"81","name"=>"ตั้ม","login"=>"ถ้ำพ่อมด");
		$d = array("id"=>"82","name"=>"เก็ก","login"=>"ข้าวปลอดภัย");

		$result = array($a,$b,$c,$d);
		//echo $q;
		//$result = retrieve($q);
		echo $_GET['callback'].'('.json_encode($result).')';	
				
	}			
?>
