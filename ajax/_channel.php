<?
	include_once('../_db.php');
	include_once('_months.php');

	if ($dbh === null) {
		//Error
	} else {
if(isset($_GET['year'])) {
      $year = $_GET['year'];
    } 


$section = "SELECT disTINCT l.section_id,c.name FROM crm_lead l,crm_case_section c where l.section_id = c.id and l.section_id is not null order by l.section_id desc";
$r1 = retrieve($section);
$asection = array();
foreach($r1 as $v) {
  $asection[] = $v['name'];
}	
$jsonb = array();
foreach($em as $k => $v) {	
	$mnum = name_to_nmonth($mn,$v);
	$num = days_in_month($mnum, $year);
	$nn = name_to_n2($m2,$mnum);

  if($nn != "00") {
  	$q = "
  		SELECT a.id , COALESCE(b.count, 0) AS Count
  	FROM 
      (
          SELECT 8 AS id
          UNION
          SELECT 9 AS id
          UNION
          SELECT 10 AS id
          UNION
          SELECT 11 AS id
      ) a LEFT JOIN 
      (
          SELECT s.name,count(c.id),s.id as cid from crm_lead c,crm_case_section s 
          WHERE c.section_id = s.id 
          AND (c.create_date, c.create_date) OVERLAPS ('{$year}-{$nn}-01'::DATE, '{$year}-{$nn}-{$num}'::DATE)
          GROUP BY s.name,s.id
          ORDER BY s.id desc
      ) b 
      ON a.id = b.cid
  		";
      //echo $q."<br><br>";

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

$jsona[] = array("label" => $asection,"values" => $jsonb);



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
