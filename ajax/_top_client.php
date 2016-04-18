<?php
    include_once '../_db.php';
    if ($dbh === null) {
        //Error
    } else {
        if (isset($_GET['type'])) {
            if ($_GET['type'] == 'quantity') {
                $q = 'select DISTINCT c.partner_id,p.name,p.ref as tax_id,count(c.id) as jobs,COALESCE(sum(c.planned_revenue) , 0) from crm_lead c,res_partner p where c.partner_id = p.id group by c.partner_id,p.name,p.ref order by jobs desc limit 5';
            } elseif ($_GET['type'] == 'money') {
                $q = 'select DISTINCT c.partner_id,p.name,p.ref as tax_id,count(c.id) as jobs,COALESCE(sum(c.planned_revenue) , 0) as money from crm_lead c,res_partner p where c.partner_id = p.id group by c.partner_id,p.name,p.ref order by money desc limit 20';
            }
        } else {
            $q = 'select DISTINCT c.partner_id,p.name,p.ref as tax_id,count(c.id) as jobs,COALESCE(sum(c.planned_revenue) , 0) from crm_lead c,res_partner p where c.partner_id = p.id group by c.partner_id,p.name,p.ref order by jobs desc limit 20';
        }

        $result = retrieve($q);
        echo $_GET['callback'].'('.json_encode($result).')';
    }
