<html>
  <body>
   <?php
        session_start();
   $eid=$_POST["e1"];
   $name=$_POST["e2"];
   $dept=$_POST["e3"];

   $_SESSION["eid"]=$eid;
  $_SESSION["name"]=$name;
  $_SESSION["dept"]=$dept;

     ?>
<form method="POST" action="empsession.php" >
   Enter loan no::<input type="text" name="l1"><br>
   Enter  loan amt::<input type="text" name="l2"><br>
   Enter loan type::<input type="text" name="l3"><br>
<input type="submit">
</form>
  </body>
</html>