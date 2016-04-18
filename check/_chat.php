<?php
    header('Content-Type: text/html; charset=utf-8');
    include '_db_mysql.php';
// $timezone = "set timezone TO 'GMT'";
// 		retrieve($timezone);

    $job_no = $_GET['job_no'];
// 	$q = "select id,name from crm_lead where name like  lpad({$job_no}::text, 5, '0')";
// 	$a = retrieve($q);
// 	//echo $q;
// 	$res_id;
// 	foreach($a as $v){
// 		$res_id = $v['id'];
// 	}

// 	$q2 = "select m.id,m.body_text,m.res_id,to_char(m.create_date::timestamp AT TIME ZONE '+0','dd/mm/yy HH24:MI') as create_date,u.name as user from mail_message m,res_users u where res_id = {$res_id} and m.user_id = u.id order by m.create_date";
// 	//echo $q2;
// 	$a2 = retrieve($q2);

    //{"id":"276748",
    //"body_text":"Changed Stage to: \u0e32\u0e19",
    //"res_id":"22059","create_date":"26\/11\/15 02:41",
    //"user":"\u0e2a\u0e32\u0e27"}

    //,{"id":"276749","body_text":null,"res_id":"22059","create_date":"26\/11\/15 02:41","user":"\u0e2a\u0e32\u0e27"}

    $sql = "SELECT o.id as id,  
	p.name_w as user,
	c.name as body_text,
	i.order_id as order_id,
	i.id as res_id,
	i.quantity,
	i.price,
	i.created_at as create_date 
	FROM core.order o, core.order_item i, core.product p, core.category c 
	WHERE o.id = {$job_no}
	AND i.order_id = o.id 
	AND i.product_id = p.id 
	AND p.category_id = c.id";

    $result = retrieve($sql);

    echo $_GET['callback'].'('.json_encode($result).')';
