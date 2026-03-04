<html>
<body>
<form method="POST" action="#">
 Enter String:<input type="text" name="t1"><br>
1)length<br>
2)vowel<br>
3)lowercase<br>
4)padding<br>
5)trimming<br>
6)reverse<br>
 Enter choice:<input type="text" name="c"><br>
<input type="submit" name="submit">
</form>
</body>
</html>
<?php
$str=$_POST['t1'];
$ch=$_POST['c'];
 function length($str)
{
$cnt=0;
while($str[$cnt]!=null)
{
 $cnt++;
}
 echo "lenght::" . $cnt;
}
 function countv($str)
{
  $c=0;
   $str1=strtolower($str);
  for($i=0; $i<strlen($str); $i++)
 {
     if($str[$i]=='a' || $str[$i]=='e' || $str[$i]=='i' || $str[$i]=='o' || $str[$i]=='u')
           {
                $c++;
            }
    }
       echo "Vowel Count: " .$c;
}
switch($ch)
{
  case 1:length($str);
               break;
case 2:countv($str);
             break;
case 3:echo" string::" .strtolower($str);
             break;
case 4:echo "string::".str_pad($str,10,"*");
             break;
case 5:echo "string::".ltrim($str);
             break;
case 6:echo "string::".strrev($str);
             break;
}
?>