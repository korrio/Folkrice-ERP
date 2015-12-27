<?
	include_once('_db_mysql.php');
	if ($dbh === null) {
		//Error
	} else {

		//$q = "SELECT * FROM crm_case_stage order by probability";
		//echo $q;
		$a[] = array("id"=>"seed","name"=>"หว่านเมล็ด","probability"=>"10","sequence"=>"1");
		$a[] = array("id"=>"harvest","name"=>"เก็บเกี่ยว","probability"=>"20","sequence"=>"2");
		$a[] = array("id"=>"ricemill","name"=>"โรงสี","probability"=>"30","sequence"=>"3");
		$a[] = array("id"=>"packing","name"=>"แพ็คของ","probability"=>"40","sequence"=>"4");
		$a[] = array("id"=>"ready","name"=>"พร้อมส่ง","probability"=>"50","sequence"=>"5");
		$a[] = array("id"=>"basket","name"=>"ตระกร้า","probability"=>"60","sequence"=>"6");
		$a[] = array("id"=>"checkout","name"=>"เช็คเอ้าท์","probability"=>"70","sequence"=>"7");
		$a[] = array("id"=>"paid","name"=>"จ่ายเงินแล้ว","probability"=>"80","sequence"=>"8");
		$a[] = array("id"=>"deliver","name"=>"กำลังสั่ง","probability"=>"90","sequence"=>"9");
		$a[] = array("id"=>"done","name"=>"ส่งแล้ว","probability"=>"100","sequence"=>"10");

		$result = $a;

		echo $_GET['callback'].'('.json_encode($result).')';	
				
	}			
?>
