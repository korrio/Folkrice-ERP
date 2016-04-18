<?php
    include '../_db.php';
    include '_timediff.php';
    $jobs = json_decode($_GET['job_no']);

    foreach ($jobs as $key => $val) {
        //$q = "select l.res_id,to_char(l.create_date,'dd/mm/yy HH24:MI') as my_date,l.name,u.login as my_user from res_log l,res_users u where l.user_id = u.id and l.name like '%{$job_no}%' order by l.write_date";
        $timezone = "set timezone TO 'GMT'";
        retrieve($timezone);
        $q = "select l.res_id,l.create_date::timestamp AT TIME ZONE '+0' as my_date,l.name,u.login as my_user from res_log l,res_users u where l.user_id = u.id and l.name like '%{$val}%' order by l.create_date,l.res_id";
        $a = retrieve($q);
        $last = strtotime('now');

        $json;
        $i = 1;
        foreach ($a as $k => $v) {
            $str = explode("'", $v['name']);
            if ($str[3] != null) {
                $p = strtotime($v['my_date']) - $last;
                $json[$i - 1]['interval'] = d_time($p);
                $json[$i]['start'] = $v['my_date'];
                $json[$i]['name'] = $str[1];
                $json[$i]['status'] = $str[3];
                $json[$i]['user'] = $v['my_user'];
                $last = strtotime($v['my_date']);
                $i++;
            }
        }
        $json[$i - 1]['interval'] = 0;
        unset($json[0]);
        $status = [];
        $values = [];
        $label = explode(' ', $json[1]['name']);
        foreach ($json as $k => $v) {
            $status[] = $v['status'];
            $values[] = $v['interval'];
        }
        $all = [];
        $all[] = ['label' => $label[0], 'values' => $values];
    }

    $jsons = ['label' => $status, 'values' => $all];

    $sample = "{
      'label': ['status A', 'status B', 'status C', 'status D'],
      'values': [
      {
        'label': '32342',
        'values': [20, 40, 15, 5]
      }, 
      {
        'label': '32343',
        'values': [30, 10, 45, 10]
      }, 
      {
        'label': '32344',
        'values': [38, 20, 35, 17]
      }, 
      {
        'label': '32345',
        'values': [58, 10, 35, 32]
      }
      ]
      
  }";

        echo $_GET['callback'].'('.json_encode($jsons, JSON_NUMERIC_CHECK).')';
