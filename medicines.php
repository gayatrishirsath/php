<?php
// medicines.php
include("config.php");

$msg = "";
$err = "";

// Add new medicine
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_medicine'])) {
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $price = (float)$_POST['price'];
    $expdate = $_POST['expdate'];
    $quantity = (int)$_POST['quantity'];

    // Basic validations
    if ($name === "" || $type === "" || $price <= 0 || $quantity < 0 || $expdate === "") {
        $err = "Please fill all fields with valid values.";
    } elseif (strtotime($expdate) <= strtotime(date('Y-m-d'))) {
        $err = "Expiry date must be in the future!";
    } else {
        $stmt = $conn->prepare("INSERT INTO medicines (name, type, price, expdate, quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $name, $type, $price, $expdate, $quantity);
        if ($stmt->execute()) {
            $msg = "Medicine added successfully!";
        } else {
            $err = "DB Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Reduce quantity (update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $mid = (int)$_POST['mid'];
    $reduce = (int)$_POST['reduce_qty'];
    if ($mid <= 0 || $reduce <= 0) {
        $err = "Please enter valid MID and quantity to reduce.";
    } else {
        // Check current quantity
        $stmt = $conn->prepare("SELECT quantity FROM medicines WHERE MID = ?");
        $stmt->bind_param("i", $mid);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            $current = (int)$row['quantity'];
            if ($reduce > $current) {
                $err = "Cannot reduce more than current quantity ($current).";
            } else {
                $stmt->close();
                $stmt2 = $conn->prepare("UPDATE medicines SET quantity = quantity - ? WHERE MID = ?");
                $stmt2->bind_param("ii", $reduce, $mid);
                if ($stmt2->execute()) {
                    $msg = "Quantity updated successfully!";
                } else {
                    $err = "DB Error: " . $stmt2->error;
                }
                $stmt2->close();
            }
        } else {
            $err = "Medicine with MID $mid not found.";
            $stmt->close();
        }
    }
}

// Delete medicine (via GET ?delete=ID)
if (isset($_GET['delete'])) {
    $del = (int)$_GET['delete'];
    if ($del > 0) {
        $stmt = $conn->prepare("DELETE FROM medicines WHERE MID = ?");
        $stmt->bind_param("i", $del);
        if ($stmt->execute()) {
            $msg = "Medicine deleted successfully!";
        } else {
            $err = "DB Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $err = "Invalid MID for delete.";
    }
}

// Fetch all medicines (sorted by expdate asc)
$medicines = $conn->query("SELECT * FROM medicines ORDER BY expdate ASC, name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Medicines Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  :root{
    --rose:#ff4d79;
    --light-rose:#fff0f5;
  }
  body { font-family: Arial, Helvetica, sans-serif; background: var(--light-rose); padding: 20px; margin:0; }
  .container { max-width:1100px; margin: 0 auto; }
  header { text-align:center; padding: 20px 0; }
  h1 { color: var(--rose); margin:0; }
  .topbar { display:flex; justify-content:space-between; gap:10px; align-items:center; margin-bottom:12px; }
  .message { text-align:center; padding:8px 12px; border-radius:6px; margin-bottom:12px; }
  .msg-success { background: #e6ffef; color: #0b8043; border:1px solid #b7f0d3; }
  .msg-error { background: #ffe6e9; color: #b00020; border:1px solid #ffc6cf; }

  table { width:100%; border-collapse:collapse; background:white; border-radius:8px; overflow:hidden; box-shadow:0 6px 20px rgba(0,0,0,0.08); }
  th, td { padding:12px 10px; text-align:center; border-bottom:1px solid #f4e6ef; }
  th { background: linear-gradient(180deg, #fff, #fff8fb); color:var(--rose); font-weight:700; }
  tr:last-child td { border-bottom: none; }
  .alert { color: #b00020; font-weight:700; }
  .out { color: #b00020; font-weight:700; }
  .actions a { text-decoration:none; color:var(--rose); padding:6px 10px; border-radius:6px; border:1px solid #ffd6e0; background:#fff; }
  .controls { display:flex; gap:10px; justify-content:center; margin:18px 0 28px 0; flex-wrap:wrap; }
  .controls button { padding:10px 14px; border-radius:8px; border:none; cursor:pointer; background:var(--rose); color:white; font-weight:600; }
  .form-card { background:white; padding:18px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.06); width:420px; margin:0 auto 20px auto; display:none; }
  .form-row { margin-bottom:10px; }
  input[type=text], input[type=number], input[type=date], select { width:100%; padding:10px; border-radius:6px; border:1px solid #e6d7df; box-sizing:border-box; }
  .small { width:120px; display:inline-block; }
  .danger { background:#ffb6c1; color:white; }
  @media(max-width:700px){
    .form-card { width: 92%; }
    th, td { font-size:14px; padding:10px 6px; }
  }
</style>
</head>
<body>
<div class="container">
  <header>
    <h1>Medicines Management</h1>
    <p style="color:#666; margin-top:6px;">Add, reduce stock, delete & monitor expiry</p>
  </header>

  <?php if($msg): ?>
    <div class="message msg-success"><?=htmlspecialchars($msg)?></div>
  <?php endif; ?>
  <?php if($err): ?>
    <div class="message msg-error"><?=htmlspecialchars($err)?></div>
  <?php endif; ?>

  <div class="topbar">
    <div style="font-weight:600; color:#555;">Total medicines: <?= $medicines ? $medicines->num_rows : 0 ?></div>
    <div class="controls">
      <button onclick="showForm('addForm')">Add Medicine</button>
      <button onclick="showForm('updateForm')">Update Quantity</button>
    </div>
  </div>

  <!-- Add Form -->
  <div id="addForm" class="form-card">
    <form method="POST" onsubmit="return validateAdd()">
      <h3 style="margin-top:0;">Add Medicine</h3>
      <div class="form-row"><input type="text" name="name" id="name" placeholder="Medicine Name" required></div>
      <div class="form-row"><input type="text" name="type" id="type" placeholder="Type (e.g. Tablet, Injection)" required></div>
      <div class="form-row"><input type="number" step="0.01" name="price" id="price" placeholder="Price" required></div>
      <div class="form-row"><input type="date" name="expdate" id="expdate" placeholder="Expiry Date" required></div>
      <div class="form-row"><input type="number" name="quantity" id="quantity" placeholder="Quantity" required></div>
      <div style="display:flex; gap:8px;">
        <button type="submit" name="add_medicine">Add Medicine</button>
        <button type="button" onclick="hideForms()" style="background:#f2f2f2; color:#333; border:1px solid #e6d7df;">Cancel</button>
      </div>
    </form>
  </div>

  <!-- Update Quantity Form -->
  <div id="updateForm" class="form-card">
    <form method="POST" onsubmit="return validateUpdate()">
      <h3 style="margin-top:0;">Update Quantity (Reduce)</h3>
      <div class="form-row"><input type="number" name="mid" id="mid" placeholder="Medicine ID (MID)" required></div>
      <div class="form-row"><input type="number" name="reduce_qty" id="reduce_qty" placeholder="Reduce Quantity" required></div>
      <div style="display:flex; gap:8px;">
        <button type="submit" name="update_quantity">Update Quantity</button>
        <button type="button" onclick="hideForms()" style="background:#f2f2f2; color:#333; border:1px solid #e6d7df;">Cancel</button>
      </div>
    </form>
  </div>

  <!-- Medicines Table -->
  <table>
    <thead>
      <tr>
        <th>MID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Expiry Date</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $today = date('Y-m-d');
    if ($medicines && $medicines->num_rows > 0) {
        while ($row = $medicines->fetch_assoc()) {
            $alert = "";
            $exp = $row['expdate'];
            $diff = (strtotime($exp) - strtotime($today)) / (60*60*24);
            if ($row['quantity'] <= 0) {
                $alert = "<span class='out'>Out of Stock</span>";
            } elseif ($diff <= 0) {
                $alert = "<span class='alert'>Expired</span>";
            } elseif ($diff <= 30) {
                $alert = "<span class='alert'>Expiry Soon!</span>";
            }
            echo "<tr>
                    <td>".htmlspecialchars($row['MID'])."</td>
                    <td>".htmlspecialchars($row['name'])."</td>
                    <td>".htmlspecialchars($row['type'])."</td>
                    <td>₹".htmlspecialchars(number_format($row['price'],2))."</td>
                    <td>".htmlspecialchars($row['expdate'])."</td>
                    <td>".htmlspecialchars($row['quantity'])."</td>
                    <td>$alert</td>
                    <td class='actions'>
                      <a href='?delete=".urlencode($row['MID'])."' onclick=\"return confirm('Delete this medicine?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No medicines found.</td></tr>";
    }
    ?>
    </tbody>
  </table>

  <footer style="text-align:center; margin-top:18px; color:#666;">
    © <?= date('Y') ?> Pharmacist Inventory
  </footer>
</div>

<script>
function showForm(id){
  document.getElementById('addForm').style.display = (id==='addForm') ? 'block' : 'none';
  document.getElementById('updateForm').style.display = (id==='updateForm') ? 'block' : 'none';
  window.scrollTo({top:0, behavior:'smooth'});
}
function hideForms(){
  document.getElementById('addForm').style.display = 'none';
  document.getElementById('updateForm').style.display = 'none';
}
function validateAdd(){
  const exp = document.getElementById('expdate').value;
  if(!exp){ alert('Please select expiry date'); return false;}
  if(new Date(exp) <= new Date(new Date().toISOString().slice(0,10))){ alert('Expiry must be future date'); return false;}
  return true;
}
function validateUpdate(){
  const mid = document.getElementById('mid').value;
  const r = document.getElementById('reduce_qty').value;
  if(mid <= 0 || r <= 0){ alert('Enter valid MID and quantity'); return false;}
  return true;
}
</script>
</body>
</html>
