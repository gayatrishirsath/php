<?php
session_start();
include("config.php");  // Database connection

if(isset($_POST['login'])){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    // Check credentials in login table
    $sql = "SELECT * FROM login WHERE Uname='$uname' AND pass='$pass'";
    $res = $conn->query($sql);

    if($res->num_rows > 0){
        $_SESSION['uname'] = $uname;  // Store username in session
        header("Location: home.php"); // Redirect to home page
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Smart Medical</title>
    <style>
        body {
            font-family: Arial;
            background: pink; /* Pink background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: white; /* White form box */
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0px 10px 25px lightpink; /* Light pink shadow */
            width: 320px;
            text-align: center;
        }
        h2 {
            color: deeppink; /* Heading color */
            margin-bottom: 25px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid lightpink; /* Input border */
        }
        input:focus {
            border-color: deeppink;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: deeppink; /* Button color */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }
        button:hover {
            background-color: hotpink; /* Button hover */
        }
        .error { 
            color: red; 
            margin-top: 10px; 
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="uname" placeholder="Username" required><br>
        <input type="password" name="pass" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p class="error"><?php if(isset($error)) echo $error; ?></p>
</div>

</body>
</html>
