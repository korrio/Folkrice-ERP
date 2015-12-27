<?
	include_once('_db_mysql.php');
	if ($dbh === null) {
		//Error
	} else {
		$job_no = $_GET['job_no'];
		$state = $_GET['state'];
		$stage = $_GET['stage'];
		$holder = $_GET['holder'];
		$partner = $_GET['partner'];

		$q = "SELECT 
		o.id as job_no,
		o.account_id as create_uid,
		o.state as s_name,
		o.created_at as date_open,
		'open' as state,
		'folkrice' as login,
		DATE_ADD(o.created_at, INTERVAL 7 DAY) as date_deadline,
		a.email as fax,
		a.email as p_name,
		'80' as probability
		FROM core.order o,core.account a
		WHERE o.account_id = a.id ";

		if(isset($_GET['job_no']) && $_GET['job_no'] != "")
			$q .= "AND o.id = {$_GET['job_no']} ";

		if(isset($_GET['partner']) && $_GET['partner'] != "") {
			$partner = $_GET['partner'];
			$q .= "AND a.email LIKE '%{$partner}%' ";
		}

		if(isset($_GET['stage']) == 'basket')
			$q .= "AND o.state LIKE '%{$stage}%' ";

		$q .= "ORDER BY o.created_at DESC
		LIMIT 30";

		$result = retrieve($q);

	//fax + job_no + date_open + date_deadline + p_name + state + s_name + probability + login 


		$a = '{"id":"3976",
		"create_uid":"54",
		"create_date":"2015-01-26 04:08:31.707961",
		"probability":"40",
		"partner_id":"3976",
		"priority":"3",
		"state":"open",
		"fax":"Letter Head A:4",
		"description":null,
		"date_open":"2015-06-04 07:11:47",
		"date_deadline":"2015-06-10",
		"categ_id":null,"stage_id":"42",
		"name":"Samui Cliff View Resort And Spa",
		"login":"mam",
		"password":"mam",
		"job_no":"53817",
		"s_name":"\u0e2d\u0e32\u0e23\u0e4c\u0e15-\u0e40\u0e1e\u0e25\u0e17",
		"p_name":"Samui Cliff View Resort And Spa",
		"customer_no":"3976"}';

// 		$q = "SELECT *,c.name as job_no,s.name as s_name,p.name as p_name,c.partner_id as customer_no,
// 		u.login FROM crm_lead c,crm_case_stage s,res_users u,res_partner p 
// 		WHERE c.type = 'opportunity' 
// 		AND c.stage_id = s.id 
// 		AND c.user_id = u.id 
// 		AND c.partner_id = p.id ";
// 		if(isset($_GET['job_no']) && $_GET['job_no'] != "") {
// 			$q .= "AND (lower(c.name) like lower('%{$job_no}%') or c.fax like '%{$job_no}%') ";
// 		}
// 		//if(isset($_GET['state']) && $_GET['state'] != "") {
// 			$q .= "AND (c.state like 'open') ";
// 			//$q .= "AND (c.state like 'open') ";
// 		//}
// 		if(isset($_GET['stage']) && $_GET['stage'] != "") {
// 			$q .= "AND c.stage_id = {$stage} ";
// 		}
		
// 		if(isset($_GET['holder']) && $_GET['holder'] != "") {
// 			$q .= "AND u.login = '{$holder}' ";
// 		}

// 		if(isset($_GET['partner']) && $_GET['partner'] != "") {
// 			$q .= "AND (lower(p.name) like lower('%{$partner}%')) ";
// 		}
// $q .= "AND lower(c.name) not like 'del%'  ORDER BY c.date_open,c.probability,c.partner_id";
		//echo $q;

		//$result = retrieve($q);
		

		$a = '{"id":"3976",
		"create_uid":"54",
		"create_date":"2015-01-26 04:08:31.707961",
		"probability":"40",
		"partner_id":"3976",
		"priority":"3",
		"state":"open",
		"fax":"Letter Head A:4",
		"description":null,
		"date_open":"2015-06-04 07:11:47",
		"date_deadline":"2015-06-10",
		"categ_id":null,"stage_id":"42",
		"name":"Samui Cliff View Resort And Spa",
		"login":"mam",
		"password":"mam",
		"job_no":"53817",
		"s_name":"\u0e2d\u0e32\u0e23\u0e4c\u0e15-\u0e40\u0e1e\u0e25\u0e17",
		"p_name":"Samui Cliff View Resort And Spa",
		"customer_no":"3976"}';

		
		$aJson = json_decode($a);
		$bJson = json_decode($a);

		//$result = array($aJson);


		echo $_GET['callback'].'('.json_encode($result).')';	
				
	}			
?>
