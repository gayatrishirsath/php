<html>
<body>
<style>
 body {
      font-family: 'Poppins', sans-serif;
      background-color: hotpink;
      margin: 0;
      padding: 0;
      display: flex;
    }
 .col-sm-4 {
      background-color: white;
      color: black;
      border-radius: 10px;
      padding: 20px;
      margin: 10px 0;
      font-size: 15px;
      transition: 0.3s;
    }

    .col-sm-4:hover {
      border: 2px solid black;
    }
</style>
  <!-- Vertical Navbar -->
  <nav>
        <a href="suppliers.php">Supplier</a>
        <a href="medicines.php">Medicines</a>
        <a href="customers.php">Customer</a>
        <a href="orders.php">Orders</a>
        <a href="payments.php">Payment Records</a>
        <a href="logout.php">Logout</a> 
 </nav>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Main content -->
       <h1><b>Medical 🩺<b></h1>
      <p>"Where healing, care, and compassion meet."</p>
    <div class="container">

    <div class="row ">
      <div class="col-sm-4">
              "Medicine is a science of uncertainty and an art of probability."
         </div>
      <div class="col-sm-4">
              "The best doctor gives the least medicines."
         </div>
      <div class="col-sm-4">
              "Healing is a matter of time, but it is sometimes also a matter of opportunity."
       </div>
    </div>
  </div>
 </body>
</html>
