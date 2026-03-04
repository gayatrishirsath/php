<html>
<html>
<body>
<form method="post">
    Enter Serial Number:
    <input type="text" name="t1" placeholder="Enter 5 serial no "><br>
    Enter Subject Name:
    <input type="text" name="t2" placeholder="Enter 5 subject names "><br>
    Enter Subject Marks:
    <input type="text" name="t3" placeholder="Enter 5 marks out of 100 )"><br>
    <input type="submit">
</form>
</body>
</html>

<?php 
 {
    $sr = $_POST["t1"];
    $sn = $_POST["t2"];
    $m  = $_POST["t3"];

    $a = explode(" ", $sr);
    $b = explode(" ", $sn);
    $c = explode(" ", $m);

    echo("<table border='1'>");
    echo("<tr>");
    echo("<th>SR.NO</th>");
    echo("<th>SUB NAME</th>");
    echo("<th>SUB MARKS</th>");
    echo("</tr>");

    $s = 0;
    for ($i = 0; $i < 5; $i++) 
{
        echo("<tr>");
        echo("<td>$a[$i]</td>");
        echo("<td>$b[$i]</td>");
        echo("<td>$c[$i]</td>");
        echo("</tr>");
        $s += $c[$i];
    }

    $p = $s / 5;
    if ($p >= 90)
        $g = "O";
    else if ($p >= 70)
        $g = "A";
    else if ($p >= 60)
        $g = "B";
    else if ($p >= 50)
        $g = "C";
    else if ($p >= 35)
        $g = "PASS";
    else
        $g = "FAIL";

    echo("<tr><td colspan='2'>TOTAL MARKS</td><td>$s</td></tr>");
    echo("<tr><td colspan='2'>PERCENTAGE</td><td>$p%</td></tr>");
    echo("<tr><td colspan='2'>GRADE</td><td>$g</td></tr>");
    echo("</table>");
}
?>
