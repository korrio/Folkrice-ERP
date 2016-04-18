<?php
    include '../_db.php';
    include '_months.php';
    include '_partner_categ.php';
    $n = $_POST['mno'];

    $filename = 'customers.xls'; // The file name you want any resulting file to be called

    header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=$filename");

    $q = 'SELECT id,name FROM res_partner order by name';
    $a = retrieve($q);

    $header = ['CUSTOMER NO.', 'NAME'];

        $str = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $str .= '<h2>รายงานฐานข้อมูลลูกค้าทั้งหมด จำนวน : '.count($a).' ราย </h2>';
        $str .= '<table>';
        $h = '';
        foreach ($header as $v) {
            $h .= '<th>'.$v.'</th>';
        }
        $str .= $h;
        //print_r($a);
        foreach ($a as $key => $val) {
            $str .= '<tr><td>'.$val['id'].'</td><td>'.$val['name'].'</td></tr>';
        }
        $str .= '</table>';
        echo $str;
        //$row = $o;
        // You can return the xls as a variable to use with;
        // $sheet = $xls->returnSheet();
        //
        // OR
        //
        // You can send the sheet directly to the browser as a file
        //
        //$xls->sendFile();

/*

A quick script to demo the use of the export-xls.class.php script.

*/

//include the export-xls.class.php file

// Lets add some sample data
//
// Of course this can be from a SQL query or anyother data source
//

/*
#first line
$row[] = "Jack";
$row[] = "24";
$row[] = "6ft 5";
$xls->addRow($row);

#second line
$row = array();
$row[] = "Jim";
$row[] = "22";
$row[] = "5ft 5";
$xls->addRow($row);

#add a multi dimension array
$row = array();
$row[] = array(0 =>'Jess', 1=>'54', 2=>'4ft');
$row[] = array(0 =>'Luke', 1=>'6', 2=>'2ft');
$xls->addRow($row);
*/;
