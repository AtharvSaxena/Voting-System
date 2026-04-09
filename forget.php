<?php
include "db.php";
session_start();

// Get role from URL
if (!isset($_GET['role'])) {
    die("Invalid Access");
}

$role = $_GET['role'];

// Map table + login page
if ($role == "voter") {
    $table = "voters";
    $login_page = "voterlog.php";
} elseif ($role == "candidate") {
    $table = "candidates";
    $login_page = "candlog.php";
} elseif ($role == "admin") {
    $table = "admins";
    $login_page = "adminlog.php";
} else {
    die("Invalid Role");
}

$field = ($role == "admin") ? "admin_id" : "voter_id";

// STEP 1: Get Question
if (isset($_POST['get_question'])) {
    $voter_id = $_POST['voter_id'];

    $sql = "SELECT security_question FROM $table WHERE $field='$voter_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['reset_voter'] = $voter_id;
        $_SESSION['question'] = $row['security_question'];
        $_SESSION['role'] = $role;

    } else {
        echo "<script>alert('User Not Found');</script>";
    }
}


// STEP 2: Verify Answer
if (isset($_POST['verify_answer'])) {

    $answer = strtolower(trim($_POST['answer']));
    $voter_id = $_SESSION['reset_voter'];

    $sql = "SELECT security_answer FROM $table WHERE $field='$voter_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($answer === $row['security_answer']) {
        $_SESSION['verified'] = true;
    } else {
        echo "<script>alert('Wrong Answer');</script>";
    }
}


// STEP 3: Reset Password
if (isset($_POST['reset_password'])) {

    $new_pass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $voter_id = $_SESSION['reset_voter'];

    $sql = "UPDATE $table SET password='$new_pass' WHERE $field='$voter_id'";

    if ($conn->query($sql)) {
        session_destroy();
        echo "<script>alert('Password Updated Successfully'); window.location='$login_page';</script>";
    } else {
        echo "<script>alert('Error Updating Password');</script>";
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

<title>Reset Password</title>
</head>

<body>

<div class="auth-page">

    <a href="<?= $login_page ?>" style="position:absolute; top:20px; left:20px; color:white; text-decoration:none;">
        ← Back to Login
    </a>

    <div id="container">
        <h1>Reset Password</h1>

        <!-- STEP 1 -->
        <?php if (!isset($_SESSION['question'])) { ?>
            <form method="POST">

                <div class="sign">
                    <i class="fa fa-id-card"></i>
                    <input type="text" name="voter_id" placeholder="Enter <?= ucfirst($field) ?>" required>
                </div>

                <input type="submit" name="get_question" value="Next" id="btn">

            </form>
        <?php } ?>

        <!-- STEP 2 -->
        <?php if (isset($_SESSION['question']) && !isset($_SESSION['verified'])) { ?>

            <form method="POST">

                <div class="reset-question">
                    <?php
                    $q = $_SESSION['question'];

                    if ($q == "food") echo "Favourite Food Name?";
                    if ($q == "pet") echo "First Pet Name?";
                    if ($q == "school") echo "First School Name?";
                    if ($q == "teacher") echo "Favourite Teacher Name?";
                    ?>
                </div>

                <div class="sign">
                    <i class="fa fa-key"></i>
                    <input type="text" name="answer" placeholder="Your Answer" required>
                </div>

                <input type="submit" name="verify_answer" value="Verify" id="btn">

            </form>
        <?php } ?>

        <!-- STEP 3 -->
        <?php if (isset($_SESSION['verified'])) { ?>

            <form method="POST">

                <div class="sign">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="new_password" placeholder="New Password" required>
                </div>

                <input type="submit" name="reset_password" value="Update Password" id="btn">

            </form>

        <?php } ?>

    </div>

</div>
<script src="script.js"></script>
</body>
</html>