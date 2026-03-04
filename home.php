<html>
<head>
  <meta charset="UTF-8">
  <title>Medical Page</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: lightpink; /* light rose pink background */
      color: black;
      display: flex;
      min-height: 100vh;
    }

    /* Vertical Navbar */
    nav {
      background: white;
      width: 220px;
      padding-top: 40px;
      box-shadow: 2px 0 8px gray;
      display: flex;
      flex-direction: column;
      position: fixed;
      height: 100%;
    }

    nav .logo {
      font-weight: 700;
      font-size: 22px;
      color: deeppink;
      text-align: center;
      margin-bottom: 30px;
    }

    nav a {
      text-decoration: none;
      color: black;
      padding: 15px 25px;
      font-weight: 500;
      margin: 5px 0;
      border-radius: 8px;
      transition: 0.3s all;
    }

    nav a:hover {
      background: deeppink;
      color: white;
    }

    /* Main content */
    main {
      margin-left: 220px;
      padding: 60px 40px 40px 40px;
      flex: 1;
    }

    /* Header */
    header {
      text-align: center;
      padding-bottom: 40px;
    }

    header h1 {
      font-size: 48px;
      color: deeppink;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 15px;
      margin: 0;
    }

    header p {
      margin-top: 15px;
      font-size: 18px;
      color: dimgray;
      font-style: italic;
    }

    /* Sections grid */
    .sections {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin-top: 40px;
    }

    .section {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 6px 20px lightgray;
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .section:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px gray;
    }

    .section p {
      font-size: 16px;
      color: black;
      font-style: italic;
    }

    footer {
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      font-size: 14px;
      color: dimgray;
    }

    /* Responsive */
    @media(max-width: 900px){
      nav {
        position: relative;
        width: 100%;
        flex-direction: row;
        height: auto;
        padding: 10px 0;
      }
      nav .logo {
        margin-bottom: 0;
      }
      nav a {
        margin: 0 10px;
      }
      main {
        margin-left: 0;
        padding: 20px;
      }
      .sections {
        justify-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- Vertical Navbar -->
  <nav>
        <a href="suppliers.php">Supplier</a>
        <a href="medicines.php">Medicines</a>
        <a href="payments.php">Payment Records</a>
        <a href="logout.php">Logout</a> 
 </nav>

  <!-- Main content -->
  <main>
    <header>
      <h1>Medical 🩺</h1>
      <p>"Where healing, care, and compassion meet."</p>
    </header>

    <div class="sections">
      <div class="section">
        <p>"Medicine is a science of uncertainty and an art of probability"</p>
      </div>
      <div class="section">
        <p>"The best doctor gives the least medicines."</p>
      </div>
      <div class="section">
        <p>"Healing is a matter of time, but it is sometimes also a matter of opportunity." </p>
      </div>
    </div>
  </main>
</body>
</html>
