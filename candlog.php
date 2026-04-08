<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $voter_id = $_POST['voter_id'];

    $sql = "SELECT * FROM candidates WHERE username='$username' AND voter_id='$voter_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            session_start();
            $_SESSION['candidate'] = $user['id'];
			$_SESSION['role'] = 'candidate';
			$_SESSION['username'] = $user['username'];

            echo "<script>alert('Login Successful'); window.location='candidatedashboard.php';</script>";

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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Candidate Login</title>

<style>
*{
	margin:0;
	padding:0;
	box-sizing:border-box;
	font-family:'Segoe UI', sans-serif;
}

/* BACKGROUND */
body{
	background: linear-gradient(135deg, #4facfe, #00f2fe);
	min-height:100vh;
}

/* NAVBAR */
.nav{
	height:65px;
	background: rgba(255,255,255,0.2);
	backdrop-filter: blur(10px);
	display:flex;
	align-items:center;
	justify-content:center;
	box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.link{
	display:flex;
	gap:30px;
}

.anchor{
	color:white;
	text-decoration:none;
	font-size:16px;
	padding:8px 15px;
	border-radius:20px;
	transition:0.3s;
}

.anchor:hover{
	background:white;
	color:#4facfe;
}

/* FORM CARD */
#container{
	width:380px;
	margin:60px auto;
	padding:30px;
	border-radius:15px;
	background: rgba(255,255,255,0.15);
	backdrop-filter: blur(15px);
	box-shadow:0 8px 25px rgba(0,0,0,0.3);
	text-align:center;
	color:white;
}

/* TITLE */
h1{
	margin-bottom:25px;
	font-size:26px;
	letter-spacing:1px;
}

/* INPUT FIELD */
.sign{
	display:flex;
	align-items:center;
	background:white;
	border-radius:25px;
	margin:12px 0;
	padding:8px 15px;
	box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.sign i{
	color:#4facfe;
	margin-right:10px;
}

.sign input{
	border:none;
	outline:none;
	width:100%;
	font-size:14px;
}

/* BUTTON */
#btn{
	width:100%;
	height:45px;
	margin-top:20px;
	border:none;
	border-radius:25px;
	background:linear-gradient(45deg,#4facfe,#00f2fe);
	color:white;
	font-size:16px;
	cursor:pointer;
	transition:0.3s;
}

#btn:hover{
	transform:scale(1.05);
	box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

/* LOGIN TEXT */
#log{
	color:#fff;
	font-weight:bold;
	text-decoration:none;
}

#log:hover{
	text-decoration:underline;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<a href="index.php" style="position:absolute; top:20px; left:20px; color:white; text-decoration:none;">
	← Back to Home
</a>

<!-- FORM -->
<div id="container">
	<h1>Candidate Login</h1>

	<form method="POST" action="">
		<div class="sign">
			<i class="fa fa-user"></i>
			<input type="text" name="username" placeholder="User Name" required>
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
		<label>Don't have an account? <a href="candsign.php" id="log">Sign Up</a></label>
		<br>
		<label>Forgot Password? <a href="#" id="log">Reset</a></label>
	</form>
</div>

</body>
</html>