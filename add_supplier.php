<?php
include("config.php");

// Initialize message variable
$msg = "";

// Handle Add Supplier form submission
if(isset($_POST['add_supplier'])){
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $result = $conn->query("INSERT INTO supplier (name, Contact, address) VALUES ('$name', '$contact', '$address')");

    if($result){
        $msg = "Supplier added successfully!";
    } else {
        $msg = "Error adding supplier!";
    }
}

// Handle Delete Supplier
if(isset($_GET['delete_id'])){
    $delete_id = (int)$_GET['delete_id'];
    $result = $conn->query("DELETE FROM supplier WHERE SID = $delete_id");

    if($result){
        $msg = "Supplier deleted successfully!";
    } else {
        $msg = "Error deleting supplier!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add/Delete Supplier</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: lightpink;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: white;
      padding: 40px;
      border-radius: 15px;
      width: 400px;
      box-shadow: 0 6px 20px lightgray;
      text-align: center;
    }

    h1 {
      color: deeppink;
      margin-bottom: 30px;
    }

    input, textarea, button {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 8px;
      border: 1px solid lightgray;
      font-size: 15px;
    }

    button {
      background: deeppink;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: 600;
    }

    button:hover {
      background: hotpink;
    }

    .message-box {
      font-size: 18px;
      color: deeppink;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Add Supplier</h1>
  <form method="POST">
    <input type="text" name="name" placeholder="Supplier Name" required>
    <input type="text" name="contact" placeholder="Contact" required>
    <textarea name="address" placeholder="Address" rows="3" required></textarea>
    <button type="submit" name="add_supplier">Add Supplier</button>
  </form>

  <?php if($msg != "") { ?>
    <div class="message-box"><?php echo $msg; ?></div>
  <?php } ?>
</div>

</body>
</html>
