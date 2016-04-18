<?php
    include_once '_db.php';
    if ($dbh === null) {
        //Error
    } else {
        $q2 = 'SELECT * from crm_case_stage';
        $b = retrieve($q2);
        $labels = [];
        $values = [];
        foreach ($b as $k => $v) {
            $labels[] = $v['name'];
            $state = 'open';
            $stage = $v['id'];
            $holder = $_GET['holder'];
            $q = "SELECT *,c.name as job_no,s.name as s_name,p.name as p_name,c.partner_id as customer_no,u.login FROM crm_lead c,crm_case_stage s,res_users u,res_partner p WHERE c.type = 'opportunity' AND c.stage_id = s.id AND c.user_id = u.id AND c.partner_id = p.id  ";

            $q .= "AND c.state like '{$state}' ";

            $q .= "AND c.stage_id = {$stage} ";

            $a = retrieve($q);
            $values[] = $c = count($a);
        }
        $jsona = [];
        $jsona[] = $labels;
        $jsona[] = $values;

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

        echo $_GET['callback'].'('.json_encode($jsona).')';
    }
