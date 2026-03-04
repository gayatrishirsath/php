<?php
include("config.php");

$msg = "";
$err = "";

// ADD PAYMENT
if(isset($_POST['add_payment'])){
    $customer_name = trim($_POST['customer_name']);
    $amount = (float)$_POST['amount'];
    $pay_date = $_POST['pay_date'];

    if($customer_name=="" || $amount<=0 || $pay_date==""){
        $err = "All fields required and amount must be >0!";
    } else {
        $stmt = $conn->prepare("INSERT INTO payments (customer_name, amount, pay_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $customer_name, $amount, $pay_date);
        if($stmt->execute()){ $msg="Payment added successfully!"; }
        else { $err="DB Error: ".$stmt->error; }
        $stmt->close();
    }
}

// DELETE PAYMENT
if(isset($_GET['delete'])){
    $pid = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM payments WHERE PID=?");
    $stmt->bind_param("i",$pid);
    if($stmt->execute()){ $msg="Payment deleted successfully!"; }
    else { $err="Error deleting payment!"; }
}

// FETCH PAYMENTS
$payments = $conn->query("SELECT * FROM payments ORDER BY pay_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment Records</title>
<style>
body{font-family:Arial; background:#fff0f5; padding:20px;}
h1{text-align:center; color:deeppink;}

table{width:70%; margin:20px auto; border-collapse:collapse; background:white;}
th,td{border:1px solid deeppink; padding:8px; text-align:center;}
th{background:#ffcce6;}

form{width:350px; margin:15px auto; background:white; padding:20px; border-radius:10px;}
input,button{width:100%; padding:10px; margin-bottom:10px; border-radius:5px; border:1px solid gray;}
button{background:deeppink; color:white; border:none; cursor:pointer;}
button:hover{background:hotpink;}

.message{text-align:center; color:green; font-weight:bold;}
.error{text-align:center; color:red; font-weight:bold;}

.button-group{display:flex; justify-content:space-around; margin:20px auto; width:350px;}
.button-group button{width:48%;}
</style>
</head>
<body>

<h1>Payment Records</h1>

<?php if($msg) echo "<p class='message'>$msg</p>"; ?>
<?php if($err) echo "<p class='error'>$err</p>"; ?>

<div class="button-group">
    <button onclick="showAdd()">Add Payment</button>
</div>

<form id="addForm" method="POST" style="display:none;">
    <input type="text" name="customer_name" placeholder="Customer Name" required>
    <input type="number" step="0.01" name="amount" placeholder="Amount" required>
    <input type="date" name="pay_date" required>
    <button type="submit" name="add_payment">Add Payment</button>
    <button type="button" onclick="hideForm()" style="background:#f2f2f2; color:#333; border:1px solid #e6d7df;">Cancel</button>
</form>

<table>
<tr>
<th>PID</th>
<th>Customer Name</th>
<th>Amount (₹)</th>
<th>Payment Date</th>
<th>Action</th>
</tr>

<?php
if($payments->num_rows>0){
    while($row=$payments->fetch_assoc()){
        echo "<tr>
            <td>{$row['PID']}</td>
            <td>{$row['customer_name']}</td>
            <td>".number_format($row['amount'],2)."</td>
            <td>{$row['pay_date']}</td>
            <td><a href='?delete={$row['PID']}' onclick='return confirm(\"Delete this payment?\")'>Delete</a></td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No Payments Found</td></tr>";
}
?>
</table>

<script>
function showAdd(){document.getElementById("addForm").style.display="block";}
function hideForm(){document.getElementById("addForm").style.display="none";}
</script>

</body>
</html>
