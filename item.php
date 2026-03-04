<!DOCTYPE html>
<html>
<body>
<form method="post">
    Enter Item Code:<br>
    <input type="text" name="t1" placeholder="Enter 5 item codes (space-separated)"><br>
    Enter Item Name:<br>
    <input type="text" name="t2" placeholder="Enter 5 item names (space-separated)"><br>
    Enter Unit Sold:<br>
    <input type="text" name="t3" placeholder="Enter 5 unit quantities"><br>
    Enter Rate of Item:<br>
    <input type="text" name="t4" placeholder="Enter 5 item rates"><br><br>

    <input type="submit" value="OK">
</form>
</body>
</html>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ic = $_POST["t1"];
    $in = $_POST["t2"];
    $iu = $_POST["t3"];
    $ir = $_POST["t4"];

    $a = explode(" ", $ic); // item codes
    $b = explode(" ", $in); // item names
    $c = explode(" ", $iu); // quantities
    $d = explode(" ", $ir); // rates

    echo("<table border='1'>");
    echo("<tr>");
    echo("<th>ITEM CODE</th>");
    echo("<th>ITEM NAME</th>");
    echo("<th>QUANTITY</th>");
    echo("<th>RATE</th>");
    echo("<th>AMOUNT</th>");
    echo("</tr>");

    $t = 0;
    for ($i = 0; $i < 5; $i++)
 {
        $amount = $c[$i] * $d[$i];
        echo("<tr>");
        echo("<td>$a[$i]</td>");
        echo("<td>$b[$i]</td>");
        echo("<td>$c[$i]</td>");
        echo("<td>$d[$i]</td>");
        echo("<td>$amount</td>");
        echo("</tr>");
        $t += $amount;
    }

    echo("<tr>");
    echo("<td colspan='4'><b>TOTAL</b></td>");
    echo("<td><b>$t</b></td>");
    echo("</tr>");
    echo("</table>");
}
?>
