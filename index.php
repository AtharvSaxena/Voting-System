<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <title>Online Voting System</title>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
        scroll-behavior: smooth;
      }

      body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        min-height: 100vh;
      }

      /* NAVBAR */
      .nav {
        height: 65px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        position: sticky;
        top: 0;
        z-index: 1000;
      }

      .link {
        display: flex;
        gap: 30px;
        align-items: center;
      }

      .anchor {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 20px;
        transition: 0.3s;
      }

      .anchor:hover {
        background: white;
        color: #4facfe;
      }

      /* DROPDOWN */
      .dropdown {
        position: relative;
      }

      .dropdown-btn {
        color: white;
        cursor: pointer;
        padding: 8px 15px;
        border-radius: 20px;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        top: 40px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
      }

      .dropdown-content a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
      }

      .dropdown-content a:hover {
        background: #4facfe;
        color: white;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }

      /* HERO */
      .hero {
        height: calc(100vh - 65px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        animation: fadeIn 1.5s ease;
      }

      .hero h1 {
        font-size: 50px;
      }

      .hero p {
        margin: 15px 0;
        font-size: 18px;
      }

      .btn {
        background: white;
        color: #4facfe;
        padding: 12px 25px;
        border-radius: 30px;
        text-decoration: none;
        transition: 0.3s;
      }

      .btn:hover {
        background: #4facfe;
        color: white;
      }

      /* FEATURES */
      .features {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 50px;
        flex-wrap: wrap;
      }

      .card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 25px;
        border-radius: 15px;
        width: 250px;
        text-align: center;
        color: white;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      }

      .card i {
        font-size: 30px;
        margin-bottom: 10px;
      }

      .card:hover {
        transform: translateY(-10px);
        background: white;
        color: #4facfe;
      }

      /* STEPS */
      .steps {
        text-align: center;
        padding: 50px;
        color: white;
      }

      .step-box {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
      }

      .step {
        background: white;
        color: #4facfe;
        padding: 15px 25px;
        border-radius: 25px;
        font-weight: bold;
        transition: 0.3s;
      }

      .step:hover {
        transform: scale(1.1);
        background: #4facfe;
        color: white;
      }

      /* STATS */
      .stats {
        display: flex;
        justify-content: center;
        gap: 50px;
        padding: 50px;
        color: white;
        flex-wrap: wrap;
        text-align: center;
      }

      .stat h2 {
        font-size: 35px;
      }

      /* FOOTER */
      .footer {
        text-align: center;
        padding: 20px;
        background: rgba(0, 0, 0, 0.2);
        color: white;
      }

      /* ANIMATION */
      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <div class="link">
        <a href="index.php" class="anchor">Home</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="about.html" class="anchor">About</a>

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

    <!-- HERO -->
    <div class="hero">
      <h1>Online Voting System</h1>
      <p>Secure • Transparent • Fast Digital Elections</p>
      <a href="#" class="btn">Start Voting</a>
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
  </body>
</html>
