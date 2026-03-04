<?php
  function length($s)
{
  for($i=0;$i<strlen($s);$i++);
  echo("length of string=".$i);
}
 function vcount($s)
{   $cnt=0;
  for($i=0;$i<strlen($s);$i++)
  {
    if($s[$i]=='a'||$s[$i]=='e'||$s[$i]=='i'||$s[$i]=='o'||$s[$i]=='u')
       {
        $cnt=$cnt+1;
        }
  }
echo("<br>Vowel count=".$cnt);
}
function lower($s)
{
  echo("<br>String in lowecase=".strtolower($s));
}
function padding($s)
{
   $s1=str_pad($s,10,"*",STR_PAD_BOTH);
echo("<br>$s1");
  }
length("Shrirampur");
vcount("Shrirampur");
lower("SHRIRAMPUR");
padding("ram");
?>