<?php
include "db.php";
session_start();

if(!isset($_SESSION['candidate'])){
    header("Location: candlog.php");
    exit();
}

if(!isset($_SESSION['username'])){
    header("Location: candlog.php");
    exit();
}

$candidate_id = $_SESSION['candidate'];
$candidate_name = $_SESSION['username'];

$result = $conn->query("
SELECT voters.voter_id, voters.username
FROM votes
JOIN voters ON votes.voter_id = voters.id
WHERE votes.candidate_id = '$candidate_id'
");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <title>Candidate Panel</title>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
      }

      /* BACKGROUND */
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
        justify-content: space-between;
        padding: 0 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      }

      .logo {
        color: white;
        font-size: 22px;
        font-weight: bold;
      }

      .link {
        display: flex;
        gap: 25px;
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

      /* LOGOUT BUTTON */
      .logout-btn {
        background: #ff4d4d;
      }

      .logout-btn:hover {
        background: white;
        color: #ff4d4d;
      }

      /* CONTAINER */
      .container {
        padding: 40px;
      }

      /* CARD */
      .card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        max-width: 800px;
        margin: auto;
      }

      .card h2 {
        margin-bottom: 15px;
        color: #4facfe;
        text-align: center;
      }

      /* TABLE */
      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
      }

      th {
        background: #4facfe;
        color: white;
      }

      tr:hover {
        background: #f1f1f1;
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <div class="logo">Voting System</div>

      <div>
        <a href="candidatedashboard.php" class="anchor">Dashboard</a>
        <a href="about.html" class="anchor">About</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="logout.php" class="anchor">Logout</a>
      </div>
    </div>

    <!-- DASHBOARD -->
    <div class="container">
      <div class="card">
        <h2>Voters who voted for <?= $candidate_name ?></h2>

        <table>
          <tr>
            <th>Voter ID</th>
            <th>Name</th>
          </tr>

          <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
              <td><?= $row['voter_id'] ?></td>
              <td><?= $row['username'] ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </body>
</html>
