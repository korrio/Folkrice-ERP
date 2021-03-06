<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>BarChart - จำนวนงาน/เงิน (Job Type)</title>

<!-- CSS Files -->
<link type="text/css" href="css/base.css" rel="stylesheet" />
<link type="text/css" href="css/BarChart.css" rel="stylesheet" />

<!--[if IE]><script language="javascript" type="text/javascript" src="../../Extras/excanvas.js"></script><![endif]-->

<!-- JIT Library File -->
<script language="javascript" type="text/javascript" src="js/jit.js"></script>

<!-- Example File -->
<script language="javascript" type="text/javascript" src="example3.js"></script>
<script src="js/jquery-1.7.min.js"></script>
</head>

<body onload="init();">
<div id="container">

<div id="left-container">



        <div class="text">
        <h4>
			จำนวนงาน/เงิน (Job Type)
        </h4> 
            งานในระบบแยกตามประเภท แบ่งออกเป็น 9 ประเภท คือ
        </div>
        <ul id="id-list"></ul>
        <a id="update" href="#" class="theme button white">จำนวนเงิน</a>
        <a id="update2" href="#" class="theme button white">จำนวนงาน</a>

         
</div>

<div id="center-container">
    <div id="infovis"></div>    
</div>

<div id="right-container">

<div id="inner-details"></div>

</div>

<div id="log"></div>
</div>
</body>
</html>
