<?php


function d_time($timestamp, $precision = 2)
{
    $time = $timestamp;
  //$a = array('decade' => 315576000, 'year' => 31557600, 'month' => 2629800, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'min' => 60, 'sec' => 1);
  $a = ['hour' => 3600];
    $i = 0;
    foreach ($a as $k => $v) {
        $$k = floor($time / $v);
        if ($$k) {
            $i++;
        }
        $time = $i >= $precision ? 0 : $time - $$k * $v;
        $s = $$k > 1 ? '' : '';
        $$k = $$k ? $$k.$s.'' : '';
        @$result .= $$k;
    }
  //return $result ? $result.'ago' : '1 sec to go';
  if ($result < 0) {
      $result = 0;
  }

    return $result ? $result : '0';
}

//echo elapsed_time('1234567890').'<br />'; // 3 years 5 months ago
//echo elapsed_time('1234567890', 6); // 3 years 5 months 1 week 2 days 57 mins 4 secs ago;
