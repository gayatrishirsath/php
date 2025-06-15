<?php
function add()
{
  echo("<br> ADD function<br>");
 $a=func_get_args();
 print_r($a);

$n=func_num_args();
echo("<br>Number of Arguments=".$n);

for($i=0;$i<$n;$i++)
echo("<br>Values=".func_get_arg($i));
}
add(11);
add(11,22 ,33)
?>
