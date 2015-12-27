<?
	include_once('_db.php');
	if ($dbh === null) {
		//Error
	} else {
		$tax_id = $_GET['tax_id'];
		$q = "SELECT ref,name,id FROM res_partner WHERE ref = '{$tax_id}'  ";
	
		$result = retrieve($q);
		echo $_GET['callback'].'('.json_encode($result).')';	
				
	}			
?>
