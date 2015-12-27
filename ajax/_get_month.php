<?php
	include("_months.php");
	$year2012 = $em;
	$year2013 = $em2;
	$year2014 = $em3;
	$a;
	foreach($mn as $k => $v) {
		if($k > 7) {
			$b = array($v,"2012");
			$a[] = $b;
		}
	}
	foreach($mn as $k => $v) {
			$b = array($v,"2013");
			$a[] = $b;
	}
	foreach($mn as $k => $v) {
			$b = array($v,"2014");
			$a[] = $b;
	}

	foreach($mn as $k => $v) {
			$b = array($v,"2015");
			$a[] = $b;
	}

	echo $_GET['callback'].'('.json_encode(array_filter($a)).')';	
		
?>