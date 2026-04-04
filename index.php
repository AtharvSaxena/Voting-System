<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Index</title>

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
	align-items:center;
}

/* LINKS */
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

/* DROPDOWN */
.dropdown{
	position:relative;
}

.dropdown-btn{
	color:white;
	cursor:pointer;
	padding:8px 15px;
	border-radius:20px;
	transition:0.3s;
}

.dropdown-btn:hover{
	background:white;
	color:#4facfe;
}

/* DROPDOWN MENU */
.dropdown-content{
	display:none;
	position:absolute;
	top:40px;
	background:white;
	border-radius:10px;
	box-shadow:0 4px 10px rgba(0,0,0,0.2);
	overflow:hidden;
	min-width:150px;
}

.dropdown-content a{
	display:block;
	padding:10px;
	text-decoration:none;
	color:#333;
	transition:0.3s;
}

.dropdown-content a:hover{
	background:#4facfe;
	color:white;
}

.dropdown:hover .dropdown-content{
	display:block;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="nav">
	<div class="link">
		<a href="index.php" class="anchor">Home</a>
		<a href="#" class="anchor">Elections</a>
		<a href="#" class="anchor">About</a>

		<div class="dropdown">
			<div class="dropdown-btn">Login ▾</div>
			<div class="dropdown-content">
				<a href="adminlog.php">Admin</a>
				<a href="candlog.php">Candidate</a>
				<a href="voterlog.php">Voter</a>
			</div>
		</div>

		<div class="dropdown">
			<div class="dropdown-btn">Sign Up ▾</div>
			<div class="dropdown-content">
				<a href="candsign.php">Candidate</a>
				<a href="votersign.php">Voter</a>
			</div>
		</div>

	</div>
</div>

</body>
</html>