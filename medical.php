<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Medical Inventory Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f8fb;
      color: #333;
    }
    header {
      background: #0b7dda;
      color: white;
      padding: 15px;
      text-align: center;
    }
    nav {
      background: #084c8d;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    nav .links {
      display: flex;
      gap: 15px;
    }
    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    .login-btn {
      background: #f5a623;
      color: white;
      padding: 6px 12px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
    }
    .login-btn:hover {
      background: #d48f1d;
    }
    .hero {
      text-align: center;
      padding: 40px 20px;
      background: #e6f0fa;
    }
    .hero img {
      width: 200px;
      margin-bottom: 20px;
    }
    .hero h1 {
      font-size: 2em;
      margin-bottom: 10px;
    }
    .cards {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      margin: 30px;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      width: 220px;
      text-align: center;
      transition: 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    footer {
      background: #0b7dda;
      color: white;
      text-align: center;
      padding: 10px;
      margin-top: 40px;
    }
    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        gap: 10px;
      }
      .cards {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <header>
    <h2>Smart Medical Inventory Management System</h2>
  </header>

  <nav>
    <div class="links">
      <a href="#">Home</a>
      <a href="#">Inventory</a>
      <a href="#">Orders</a>
      <a href="#">Suppliers</a>
      <a href="#">Reports</a>
    </div>
    <a href="login.html" class="login-btn">Login</a>
  </nav>

  <section class="hero">
    <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Medical Icon">
    <h1>Welcome to Smart Medical Inventory</h1>
    <p>Track medicines, manage suppliers, and monitor stock in real-time.</p>
  </section>

  <section class="cards">
    <div class="card">
      <h3>Total Medicines</h3>
      <p>120</p>
    </div>
    <div class="card">
      <h3>Low Stock</h3>
      <p>15</p>
    </div>
    <div class="card">
      <h3>Expired Items</h3>
      <p>5</p>
    </div>
    <div class="card">
      <h3>Suppliers</h3>
      <p>8</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Smart Medical Inventory. All Rights Reserved.</p>
  </footer>

</body>
</html>
