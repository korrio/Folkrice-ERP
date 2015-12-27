<?
	include_once('../_db.php');
	include_once('_months.php');



	if ($dbh === null) {
		//Error
	} else {

		if(isset($_GET['year'])) {
      $year = $_GET['year'];
    } 
$jsonb = array();
foreach($em as $k => $v) {	
	$mnum = name_to_nmonth($mn,$v);
	$num = days_in_month($mnum, $year);
	$nn = name_to_n2($m2,$mnum);

if($nn != "00"){

	$q = "
		SELECT  a.STATE , 
        COALESCE(b.count, 0) AS Count
	FROM 
    (
        SELECT 'done' AS STATE
        UNION
        SELECT 'open' AS STATE
        UNION
        SELECT 'pending' AS STATE
        UNION
        SELECT 'draft' AS STATE
        UNION
        SELECT 'cancel' AS STATE
    ) a LEFT JOIN 
    (
        SELECT  STATE , 
                count(*) AS count
        FROM    crm_lead
        WHERE (create_date, create_date) OVERLAPS ('{$year}-{$nn}-01'::DATE, '{$year}-{$nn}-{$num}'::DATE)
        GROUP BY STATE
    ) b ON a.STATE = b.STATE
		";
		$result = retrieve($q);
		
		$jsona = array();
		$values = array();
		$ev = array();
		foreach($result as $key => $val) {
			$ev[] = $val['count'];
		}

	$jsonb[] = array("label" => $v,"values" =>$ev);
}
}

$jsona[] = array("label" => array(done,open,pending,draft,cancel),"values" => $jsonb);



$json = "{
      'label': ['done', 'open', 'pending', 'draft', 'cancel'],
      'values': [
      {
        'label': 'Sept',
        'values': [20, 40, 15, 5,2]
      }, 
      {
        'label': 'Oct',
        'values': [30, 10, 45, 10]
      }, 
      {
        'label': 'Nov',
        'values': [38, 20, 35, 17]
      }]}";

		echo $_GET['callback'].'('.json_encode($jsona,JSON_NUMERIC_CHECK).')';	
		
	}

?>