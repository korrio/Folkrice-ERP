<?
	include_once('_db.php');
	if ($dbh === null) {
		//Error
	} else {
		$job_no = $_GET['job_no'];
		$state = $_GET['state'];
		$stage = $_GET['stage'];
		$holder = $_GET['holder'];
		$partner = $_GET['partner'];
		$q = "SELECT *,c.name as job_no,s.name as s_name,p.name as p_name,p.ref as tax_id,c.partner_id as customer_no,u.login from crm_lead c,crm_case_stage s,res_users u,res_partner p WHERE c.type = 'opportunity' AND c.stage_id = s.id AND c.user_id = u.id AND c.partner_id = p.id  ";
		if(isset($_GET['job_no']) && $_GET['job_no'] != "") {
			$q .= "AND c.name like '{$job_no}%' ";
		} else {
		//if(isset($_GET['state']) && $_GET['state'] != "") {
			$q .= "AND c.state = 'open' ";
		//}
		}
		if(isset($_GET['stage']) && $_GET['stage'] != "") {
			$q .= "AND c.stage_id = {$stage} ";
		}
		
		if(isset($_GET['holder']) && $_GET['holder'] != "") {
			$q .= "AND u.login = '{$holder}' ";
		}

		if(isset($_GET['partner']) && $_GET['partner'] != "") {
			//$q .= "AND c.partner_id = '{$partner}' ";
			$q .= "AND (lower(p.name) like lower('%{$partner}%')) ";
		}
		$q .= "AND lower(c.name) not like 'del%'  ORDER BY c.probability,c.partner_id";
		//PRINT $q;
		$result = retrieve($q);
		echo $_GET['callback'].'('.json_encode($result).')';	
				
	}			
?>
