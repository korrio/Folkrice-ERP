<?
	include("../_db.php");
	$timestamp = strtotime("now");
	//echo strtotime(now);
	$ts = date("Y-m-d H:i:s",$timestamp - 60 * 60 * 7);
	$job_no = $_GET['job_no'];
	$message = $_GET['message'];
	$q2 = "SELECT id,name FROM crm_lead WHERE name like '%{$job_no}%'";

	$a = retrieve($q2);
	$res_id = $a[0][id];
$ts2 = $ts.".000000";

	$q = "INSERT INTO public.mail_message (id,create_uid,create_date,write_date,write_uid,body_text,email_bcc,auto_delete,body_html,mail_server_id,email_to,email_from,date,partner_id,subject,user_id,headers,message_id,subtype,state,reply_to,email_cc,model,res_id,original,fetchmail_server_id)
					VALUES (nextval('mail_message_id_seq'::regclass),'50','{$ts2}',NULL,'50','{$message}',NULL,FALSE,'{$message}',NULL,NULL,NULL,'{$ts}',NULL,'{$message}','50',NULL,NULL,'plain','recieved',NULL,NULL,'crm.lead',{$res_id},NULL,NULL)";
	echo $q;	
retrieve($q);

?>
