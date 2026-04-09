<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {

            session_start();
            $_SESSION['admin'] = $admin['id'];
            $_SESSION['role'] = 'admin';

            echo "<script>alert('Admin Login Success'); window.location='admindashboard.php';</script>";

        } else {
            echo "<script>alert('Wrong Password');</script>";
        }

    } else {
        echo "<script>alert('Admin Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Admin Login</title>
</head>

<body>

<div class="auth-page">

    <a href="index.php" style="position:absolute; top:20px; left:20px; color:white; text-decoration:none;">
        ← Back to Home
    </a>

    <div id="container">
        <h1>Admin Login</h1>

        <form method="POST" action="">
            <div class="sign">
                <i class="fa fa-user-shield"></i>
                <input type="text" name="username" placeholder="Admin Username" required>
            </div>

            <div class="sign">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="submit" value="Login" id="btn">

            <br><br>
            <label>Forgot Password? <a href="forget.php?role=admin" id="log">Reset</a></label>
        </form>
    </div>

</div>

</body>
</html>