<html>
<body>
 <form method="POST" action="#">
 Enter first number:<input type="text" name="t1"><br>
 Enter second number:<input type="text" name="t2"><br>
 Enter choice:<input type="text" name="c"><br>
 1) Mod <br>
 2) Power <br>
 3) Sum <br>
 4) Factorial <br>
 <input type="submit" value="submit">
</form>
</body>
</html>

<?php
    $n1 = $_POST['t1'];
    $n2 = $_POST['t2'];
    $ch = $_POST['c'];

    function mod($n1, $n2)
 {
        $c = $n1 % $n2;
        echo "Mod = " . $c;
    }

    function sum($n1) 
{
        $c = 0;
        for ($i = 1; $i <= $n1; $i++) 
         {
            $c = $c + $i;
        }
        echo "Sum of first $n1 numbers = " . $c;
    }

    function power($n1, $n2)
 {
        $c = 1;
        for ($i = 1; $i <= $n2; $i++)
          {
            $c = $c * $n1;
        }
        echo "$n1 ^ $n2 = " . $c;
    }

    function factorial($n1) 
{
        $fact = 1;
        for ($i = 1; $i <= $n1; $i++)
               {
                 $fact = $fact * $i;
                 }
        echo "Factorial of $n1 = " . $fact;
    }

    switch ($ch)
 {
        case 1: mod($n1, $n2);
                break;
        case 2: power($n1, $n2);
                break;
        case 3: sum($n1);
                break;
        case 4: factorial($n1);
                break;
}
?>
