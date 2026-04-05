<?php
include "db.php";
session_start();

if(!isset($_SESSION['voter'])){
    header("Location: voterlog.php");
    exit();
}

$voter_id = $_SESSION['voter'];

// vote submit
if(isset($_POST['vote'])){
    $cid = $_POST['candidate_id'];

    $check = $conn->query("SELECT * FROM votes WHERE voter_id='$voter_id'");
    if($check->num_rows == 0){
        $conn->query("INSERT INTO votes (voter_id, candidate_id) VALUES ('$voter_id','$cid')");
    }

    header("Location: voterdashboard.php");
    exit();
}

// check voted
$voted = $conn->query("SELECT * FROM votes WHERE voter_id='$voter_id'")->num_rows > 0;

// candidates
$candidates = $conn->query("SELECT * FROM candidates");
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

    <title>Voter Dashboard</title>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
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
        justify-content: space-between;
        padding: 0 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      }

      .logo {
        color: white;
        font-size: 22px;
        font-weight: bold;
      }

      .anchor {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 20px;
      }

      /* CONTAINER */
      .container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
        padding: 40px;
      }

      /* CARD */
      .card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
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

      /* BUTTON */
      .vote-btn {
        padding: 6px 12px;
        border: none;
        background: #28a745;
        color: white;
        border-radius: 5px;
        cursor: pointer;
      }

      .vote-btn:disabled {
        background: gray;
        cursor: not-allowed;
      }

      /* RESULT BAR */
      .bar {
        height: 10px;
        background: #ddd;
        border-radius: 10px;
        overflow: hidden;
      }

      .fill {
        height: 100%;
        background: #4facfe;
      }

      /* WINNER */
      .winner {
        background: #e6f7ff !important;
        font-weight: bold;
      }

      .badge {
        background: #4facfe;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
      }

      /* MESSAGE */
      .message {
        text-align: center;
        margin-bottom: 15px;
        font-weight: bold;
        color: green;
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <div class="logo">Voting System</div>

      <div>
        <a href="voterdashboard.php" class="anchor">Dashboard</a>
        <a href="about.html" class="anchor">About</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="logout.php" class="anchor">Logout</a>
      </div>
    </div>

    <div class="container">
      <!-- VOTING SECTION -->
      <div class="card">
        <h2>Cast Your Vote</h2>

        <div id="voteMessage" class="message"></div>

        <table>
          <tr>
            <th>Candidate</th>
            <th>Party</th>
            <th>Vote</th>
          </tr>

          <?php while($row = $candidates->fetch_assoc()){ ?>
            <tr>
              <td><?= $row['username'] ?></td>
              <td><?= $row['party'] ?></td>
              <td>
                <form method="POST">
                    <input type="hidden" name="candidate_id" value="<?= $row['id'] ?>">
                    <button class="vote-btn" name="vote" <?= $voted?'disabled':'' ?>>Vote</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <!-- YOUR VOTE -->
      <div class="card">
        <h2>Your Vote</h2>
        <p style="text-align:center;">
          <?php
            if($voted){
              $r = $conn->query("SELECT candidates.username FROM votes 
                                 JOIN candidates ON votes.candidate_id=candidates.id 
                                 WHERE votes.voter_id='$voter_id'");
              echo $r->fetch_assoc()['username'];
            }else{
              echo "Not voted yet";
            }
          ?>
        </p>
      </div>
    </div>
  </body>
</html>
