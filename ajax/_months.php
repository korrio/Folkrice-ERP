<?php 
include_once('../_db.php');
include_once('../_year.php');
$ts;
$fm;
$em;
$em2; 
$em3; 

$company = "samuiaksorn";
$cm = 12;

$m2 = array("00","01","02","03","04","05","06","07","08","09","10","11","12");
$mn = array("","January","February","March","April","May","June","July","August","September","October","November","December");
$mn_thai = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	if ($dbh === null) {
		//Error
	} else {
		$q = "select to_char(create_date::timestamp AT TIME ZONE '+12','FMMonth FMDDth') as first_date,to_char(create_date::timestamp AT TIME ZONE '+12','FMMonth') as first_month from crm_lead order by create_date limit 1";
		$r = retrieve($q);
		$ts = strtotime($r[0]['first_date']);
		if($year == 2012) {
			$fm = $r[0]['first_month'];		
		} else {
			$fm = "January";
		}
		//
		
		//echo count_months($ts);
		$em = each_month($mn,$fm,$cm);
	}



function count_months($timestamp) {
	list($old_year, $old_month, $old_day) = explode('-', date('Y-m-d', $timestamp));
	list($now_year, $now_month, $now_day) = explode('-', date('Y-m-d'));

	$months_ago = 12 * ($now_year - $old_year) + $now_month - $old_month;
	if ($old_month < $now_month && $old_day < $now_day) {
	    ++$months_ago;
	}
	return abs($months_ago);
}

function each_month($mn,$first_month,$nmonths){
	$m = array();
	$n = $nmonths; 
	foreach($mn as $k => $v) {
		if($v == $first_month) {
			for($i = $k ; $i <= ($k + $n) ; $i++) {
				$m[] = $mn[$i];
			}
		}
	}
	return $m;
}

function name_to_nmonth($mn,$name) {
	foreach($mn as $k => $v) {
		if($v == $name) {
			return $k;
		}
	}
}

function name_to_n2($n2,$n) {
	foreach($n2 as $k => $v) {
		if($k == $n) {
			return $v;
		}
	}
}

  /* 
 * days_in_month($month, $year) 
 * Returns the number of days in a given month and year, taking into account leap years. 
 * 
 * $month: numeric month (integers 1-12) 
 * $year: numeric year (any integer) 
 * 
 * Prec: $month is an integer between 1 and 12, inclusive, and $year is an integer. 
 * Post: none 
 */ 
// corrected by ben at sparkyb dot net 
function days_in_month($month, $year) 
{ 
// calculate number of days in a month 
return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
} 

?>