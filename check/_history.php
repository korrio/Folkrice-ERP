<?/*
	include_once('_db.php');
	if ($dbh === null) {
		//Error
	} else {
		$job_id = $_GET['job_id'];
		$q = "select l.write_date,l.write_uid,l.name as log_detail,u.name as u_name from res_log l,res_users u where l.write_uid = u.id ";
		if(isset($_GET['job_id']) && $_GET['job_id'] != "") {
			$q .= "AND res_id = {$job_id} order by l.write_date";
		}
		//echo $q;
		$result = retrieve($q);
		echo $_GET['callback'].'('.json_encode($result).')';	
				
	}
*/

	header('Content-Type: text/html; charset=utf-8');
	include("_db.php");
	$job_no = $_GET['job_no'];
	//$q = "select l.res_id,to_char(l.create_date,'dd/mm/yy HH24:MI') as my_date,l.name,u.login as my_user from res_log l,res_users u where l.user_id = u.id and l.name like '%{$job_no}%' order by l.write_date";
$timezone = "set timezone TO 'GMT'";
retrieve($timezone);
$q = "select l.res_id,to_char(l.create_date::timestamp AT TIME ZONE '+12','dd/mm/yy HH:MI') as my_date,l.name,u.login as my_user from res_log l,res_users u where l.user_id = u.id and l.name like '%{$job_no}%' order by l.create_date";
	$a = retrieve($q);
echo $_GET['callback'].'('.json_encode($a).')';
	/*echo "<table border='1'><tr><th>index</th><th>เวลา</th><th>ชื่องาน</th><th>สถานะ</th><th>โดย</th></tr>";
	$i = 1;
	foreach ($a as $k => $v) {
		$str = explode("'", $v['name']);
		print_r("<tr><td>" . $i . "</td><td>" . $v['my_date'] . "</td><td>" . $str[1] . "</td><td>" . $str[3] . "</td><td>" . $v['my_user'] . "</td></tr>");
		$i++;
	}
	echo "</table>";	
*/	
?>
