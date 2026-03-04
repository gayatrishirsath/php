<?php
include("config.php");

// Fetch all suppliers
$suppliers = $conn->query("SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supplier List</title>
    <style>
        body {
            font-family: Arial;
            background-color: pink;
            padding: 20px;
        }
        h2 { text-align: center; color: deeppink; }
        table { width: 80%; margin: 20px auto; border: 1px solid deeppink; border-collapse: collapse; background-color: white; }
        th, td { border: 1px solid deeppink; padding: 8px; text-align: center; }
        th { background-color: lightpink; }
    </style>
</head>
<body>

<h2>Supplier List</h2>

<table>
    <tr>
        <th>SID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Address</th>
    </tr>

    <?php
    if($suppliers->num_rows > 0){
        while($row = $suppliers->fetch_assoc()){
            echo "<tr>
                    <td>{$row['SID']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['Contact']}</td>
                    <td>{$row['address']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No suppliers found</td></tr>";
    }
    ?>
</table>

</body>
</html>
