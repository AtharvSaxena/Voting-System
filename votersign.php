<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $voter_id = $_POST['voter_id'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO voters (username, email, voter_id, dob, password)
                VALUES ('$username','$email','$voter_id','$dob','$hashed')";

        if ($conn->query($sql)) {
            echo "<script>alert('Registered Successfully'); window.location='voterlog.php';</script>";
        } else {
            echo "<script>alert('Username / Email / Voter ID already exists');</script>";
        }
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

<title>Voter Signup</title>
</head>

<body>

<div class="auth-page">

    <a href="index.php" style="position:absolute; top:20px; left:20px; color:white; text-decoration:none;">
        ← Back to Home
    </a>

    <div id="container">
        <h1>Voter Sign Up</h1>

        <form method="POST" action="">

            <div class="sign">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="sign">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="sign">
                <i class="fa fa-id-card"></i>
                <input type="text" name="voter_id" placeholder="Voter ID" required>
            </div>

            <div class="sign">
                <i class="fa fa-calendar"></i>
                <input type="date" name="dob" required>
            </div>

            <div class="sign">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Create Password" required>
            </div>

            <div class="sign">
                <i class="fa fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <input type="submit" value="Register" id="btn">

            <br><br>
            <p>Already have an account? <a href="voterlog.php" id="log">Login</a></p>

        </form>
    </div>

</div>

</body>
</html>