<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $voter_id = $_POST['voter_id'];

    $sql = "SELECT * FROM voters WHERE username='$username' AND voter_id='$voter_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_start();
            $_SESSION['voter'] = $user['id'];
            $_SESSION['role'] = 'voter';

            echo "<script>alert('Login Successful'); window.location='voterdashboard.php';</script>";

        } else {
            echo "<script>alert('Wrong Password');</script>";
        }

    } else {
        echo "<script>alert('User Not Found');</script>";
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

<title>Voter Login</title>
</head>

<body>

<div class="auth-page">

    <a href="index.php" style="position:absolute; top:20px; left:20px; color:white; text-decoration:none;">
        ← Back to Home
    </a>

    <div id="container">
        <h1>Voter Login</h1>

        <form method="POST" action="">
            <div class="sign">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="sign">
                <i class="fa fa-id-card"></i>
                <input type="text" name="voter_id" placeholder="Voter ID" required>
            </div>

            <div class="sign">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="submit" value="Login" id="btn">

            <br><br>
            <label>Don't have an account? <a href="votersign.php" id="log">Sign Up</a></label>
            <br>
            <label>Forgot Password? <a href="forget.php?role=voter" id="log">Reset</a></label>
        </form>
    </div>

</div>

</body>
</html>