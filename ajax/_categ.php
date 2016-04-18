<?php
    include_once '../_db.php';
    include_once '_months.php';

    if ($dbh === null) {
        //Error
    } else {
        $categ = 'SELECT disTINCT l.categ_id,c.name FROM crm_lead l,crm_case_categ c where l.categ_id = c.id and l.categ_id is not null order by l.categ_id';
        $r1 = retrieve($categ);
        $acateg = [];

        foreach ($r1 as $v) {
            $acateg[] = $v['name'];
        }

/*
for($i = count($r1) ; $i > 0 ; $i--) {
  $acateg[] = $r1[$i-1]['name'];
}
*/

$jsonb = [];
        foreach ($em as $k => $v) {
            $mnum = name_to_nmonth($mn, $v);
            $num = days_in_month($mnum, $year);
            $nn = name_to_n2($m2, $mnum);

            $q3 = '';

            if ($nn != '00') {
                $q2 = "
      SELECT  a.categ_id , 
          COALESCE(b.count, 0) AS Count,sum_rev
    FROM 
      (
          SELECT 21 AS categ_id
          UNION
          SELECT 22 AS categ_id
          UNION
          SELECT 23 AS categ_id
          UNION
          SELECT 24 AS categ_id
          UNION
          SELECT 25 AS categ_id
          UNION
          SELECT 26 AS categ_id
          UNION
          SELECT 27 AS categ_id
          UNION
          SELECT 28 AS categ_id
          UNION
          SELECT 29 AS categ_id
  	UNION
          SELECT 30 AS categ_id
  	UNION
          SELECT 31 AS categ_id
      ) a LEFT JOIN 
      (
          SELECT l.categ_id,c.name,COALESCE(sum(l.planned_revenue) , 0) as sum_rev,count(*) FROM crm_lead l,crm_case_categ c 
          WHERE (l.create_date, l.create_date) OVERLAPS ('{$year}-{$nn}-01'::DATE, '{$year}-{$nn}-{$num}'::DATE) AND l.categ_id = c.id group by l.categ_id,c.name order by c.name desc
      ) b 

  ON a.categ_id = b.categ_id order by categ_id
      ";
  //echo $q2 . "<br/><br/>";
    $q = "
  		SELECT c.name,COALESCE(sum(l.planned_revenue) , 0) as sum_rev,count(*) FROM crm_lead l,crm_case_categ c WHERE (l.create_date, l.create_date) OVERLAPS ('{$year}-{$nn}-01'::DATE, '{$year}-{$nn}-{$num}'::DATE) AND l.categ_id = c.id group by c.name
  		";
                $result = retrieve($q2);

                $jsona = [];
                $values = [];
                $ev = [];
                foreach ($result as $key => $val) {
                    $ev[] = $val['count'];
                }

                $jsonb[] = ['label' => $v, 'values' => $ev];
            }
        }

        $jsona[] = ['label' => $acateg, 'values' => $jsonb];

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

        echo $_GET['callback'].'('.json_encode($jsona, JSON_NUMERIC_CHECK).')';
    }
