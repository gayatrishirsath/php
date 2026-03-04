<html>
   <body>
<?php
    session_start();
 $eid=$_SESSION["e1"];
   $name=$_SESSION["e2"];
   $dept=$_SESSION["e3"];

  $lno=$_POST["l1"];
   $amt=$_POST["l2"];
   $amt=$_POST["l3"];

 echo"empid:". $eid;


?>
  </body>
</html>