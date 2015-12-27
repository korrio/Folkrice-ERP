<?php
	include('../_db.php');
	include('_months.php');
	include('_partner_categ.php');
	$a = explode(",", $_POST['mno']); 
	$n = $a[0];
	$y = $a[1];
	$filename = $mn[$n].$a[1].'.xls'; // The file name you want any resulting file to be called

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$filename");
	
	$header = array("DATE","HOTEL/FIRM","CODE","JOB DESCRIPTION","JOB.","QTY","PRICE","AMOUNT","PAPER","COLOR","งานหลังพิมพ์","จำนวนเที่ยววิ่ง","ช่างอาร์ต","เครื่องพิมพ์","ช่างพิมพ์","COOR","NEW/OLD","วันที่เสร็จ","TEL.");
function username($id,$users) {
	foreach($users as $k => $v) {
		if($v['id'] == $id)
			return $v['name'];
	}
}

function machinename($id,$machines) {
	foreach($machines as $k => $v) {
		if($v['id'] == $id)
			return $v['name'];
	}
}

function typename($id,$types) {
	foreach($types as $k => $v) {
		if($v['id'] == $id)
			return $v['name'];
	}
}

function get_categ($id){
		$q3 = "select id,name from res_partner where id = {$id}";
		$a3 = retrieve($q3);

		$q = "select * from res_partner_category_rel where partner_id = {$id}";
		$a = retrieve($q);
		$c = array();
		$i = 0;
		foreach($a as $v) {
			$cat = $v['category_id'];
			$q2 = "select id,name from res_partner_category where id = {$cat}";
			$a2 = retrieve($q2);
			if($i == 0) {				
				$cstr = $a2[0]['name'];
			} else {
				$cstr .= " / ".$a2[0]['name'];
			}
			$i++;
		}
		
		
	return $cstr;
}		



	if ($dbh === null) {
		//Error
	} else {
		
		$num = days_in_month($n, 2014);
		$nn = $m2[$n];

		$q1 = "select id,name from res_users"; 
		$users = retrieve($q1);

		$q2 = "select id,name from crm_case_categ"; 
		$machines = retrieve($q2);

		$q3 = "select id,name from crm_case_resource_type";
		$types = retrieve($q3);

		$timezone = "set timezone TO 'GMT'";
		retrieve($timezone);

		$q = "
			SELECT
			l.state, 
			to_char(l.create_date::timestamp,'dd-mm-yy') as DATE,
			l.partner_id as PID,
			p.name as FIRM,
			l.fax as DESC,
			l.name as JOB,
			l.street as QTY,
			l.street2 as PRICE,
			l.planned_revenue as AMOUNT,
			l.mobile as PAPER, 
			l.zip as COLOR,
			l.birthdate as AFTER,
			l.title_action as BILL,
			l.referred as ART,
			l.phone as TEL,
			l.categ_id as MACHINE,
			l.function as LABOR,
			l.create_uid as COOR,
			l.type_id as CODE,
			to_char(l.date_closed::timestamp AT TIME ZONE '+0','dd-mm-yy') as DEADLINE 
			FROM crm_lead l, res_partner p
			WHERE
			l.partner_id = p.id 
			AND
			l.state = 'done' 
			AND 
			(l.create_date, l.create_date) OVERLAPS ('{$y}-{$nn}-1'::DATE, '{$y}-{$nn}-{$num}'::DATE)
			
			ORDER BY 
			p.name
			";
			//echo $q;
		$a = retrieve($q);

		$q2 = "SELECT id,name FROM res_users";
		$users = retrieve($q2);

		$q3 = "SELECT id,name FROM crm_case_categ"; 
		$categs = retrieve($q3);

		$o = array();
		foreach($a as $k => $v) {
			if($v["desc"] == null) {
				$a = explode(" ",$v["job"]);
				$v["job"] = $a[0];
				$v["desc"] = $a[1];
			} 
			$v["coor"] = username($v["coor"],$users);
			$v["machine"] = machinename($v["machine"],$machines);
			$v["code"] = typename($v["code"],$types);
			$partner_categ = get_categ($v["pid"]);
			//echo $v["pid"]."<br>";
			// remove "del" job no
			if (strpos(strtolower($v["job"]),'del') !== false) {
   $del[] = array(
				$v["date"],
				$v["firm"],
				$partner_categ,
				$v["desc"],
				$v["job"],
				$v["qty"],
				$v["price"],
				$v["amount"],
				$v["paper"],
				$v["color"],
				$v["after"],
				$v["bill"],
				$v["art"],				
				$v["machine"],
				$v["labor"],
				$v["coor"],
				$v["code"],
				$v["deadline"],
				$v["tel"]
				);
} else {
	$o[] = array(
				$v["date"],
				$v["firm"],
				$partner_categ,
				$v["desc"],
				$v["job"],
				$v["qty"],
				$v["price"],
				$v["amount"],
				$v["paper"],
				$v["color"],
				$v["after"],
				$v["bill"],
				$v["art"],				
				$v["machine"],
				$v["labor"],
				$v["coor"],
				$v["code"],
				$v["deadline"],
				$v["tel"]
				);
}
			
		}
		//print_r($o);
		$str = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';  
		$str .= "<h2>รายงานประจำเดือน " . $mn_thai[$n] . " จำนวน : " . count($o) . " งาน </h2>";
		$str .= "<table>";
		$h = "";
		foreach($header as $v) {
			$h .= "<th>".$v."</th>";
		}
		$str .= $h;
		//print_r($o);
		foreach($o as $key => $val) {

			$str .= "<tr><td>".$val[0]."</td><td>".$val[1]."</td><td>".$val[2]."</td><td>".$val[3]."</td><td>"."\"".$val[4]."\""."</td><td>".$val[5]."</td><td>".$val[6]."</td><td>".$val[7]."</td><td>".$val[8]."</td><td>".$val[9]."</td><td>".$val[10]."</td><td>".$val[11]."</td><td>".$val[12]."</td><td>".$val[13]."</td><td>".$val[14]."</td><td>".$val[15]."</td><td>".$val[16]."</td><td>".$val[17]."</td><td>".$val[18]."</td></tr>";
		}
		$str .= "</table>";
		echo $str;


		//$row = $o;
		# You can return the xls as a variable to use with;
		# $sheet = $xls->returnSheet();
		#
		# OR
		#
		# You can send the sheet directly to the browser as a file 
		#
		//$xls->sendFile();

	}

/*

A quick script to demo the use of the export-xls.class.php script.

*/


#include the export-xls.class.php file






# Lets add some sample data
#
# Of course this can be from a SQL query or anyother data source
#

/*
#first line
$row[] = "Jack";
$row[] = "24";
$row[] = "6ft 5";
$xls->addRow($row);

#second line
$row = array();
$row[] = "Jim";
$row[] = "22";
$row[] = "5ft 5";
$xls->addRow($row);

#add a multi dimension array
$row = array();
$row[] = array(0 =>'Jess', 1=>'54', 2=>'4ft');
$row[] = array(0 =>'Luke', 1=>'6', 2=>'2ft');
$xls->addRow($row);
*/





?>
