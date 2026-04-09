<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- External CSS -->
    <link rel="stylesheet" href="style.css" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <title>Online Voting System</title>
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <div class="link">
        <a href="index.php" class="anchor">Home</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="about.php" class="anchor">About</a>

        <!-- LOGIN DROPDOWN -->
        <div class="dropdown">
          <div class="dropdown-btn">Login ▾</div>
          <div class="dropdown-content">
            <a href="adminlog.php">Admin</a>
            <a href="candlog.php">Candidate</a>
            <a href="voterlog.php">Voter</a>
          </div>
        </div>

        <!-- SIGNUP DROPDOWN -->
        <div class="dropdown">
          <div class="dropdown-btn">Sign Up ▾</div>
          <div class="dropdown-content">
            <a href="candsign.php">Candidate</a>
            <a href="votersign.php">Voter</a>
          </div>
        </div>
      </div>
      <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn">
          🌙 Dark
      </button>
    </div>

    <!-- HERO -->
    <div class="hero">
      <h1>Online Voting System</h1>
      <p>Secure • Transparent • Fast Digital Elections</p>
      <a href="voterlog.php" class="btn">Start Voting</a>
    </div>

    <!-- FEATURES -->
    <div class="features">
      <div class="card">
        <i class="fa fa-lock"></i>
        <h3>Secure</h3>
        <p>Your vote is safe and protected.</p>
      </div>

      <div class="card">
        <i class="fa fa-eye"></i>
        <h3>Transparent</h3>
        <p>Every process is open and verifiable.</p>
      </div>

      <div class="card">
        <i class="fa fa-bolt"></i>
        <h3>Fast</h3>
        <p>Instant results with quick processing.</p>
      </div>
    </div>

    <!-- STEPS -->
    <div class="steps">
      <h2>How It Works</h2>
      <br>
      <div class="step-box">
        <div class="step">Register</div>
        <div class="step">Login</div>
        <div class="step">Vote</div>
        <div class="step">Results</div>
      </div>
    </div>

    <!-- STATS -->
    <div class="stats">
      <div class="stat">
        <h2>10K+</h2>
        <p>Users</p>
      </div>

      <div class="stat">
        <h2>500+</h2>
        <p>Elections</p>
      </div>

      <div class="stat">
        <h2>99%</h2>
        <p>Accuracy</p>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
      <p>© 2026 Online Voting System | All Rights Reserved</p>
    </div>

    <script src="script.js"></script>
  </body>
</html>