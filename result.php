<?php
include "db.php";
session_start();

$dashboard = "index.php";

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'voter'){
        $dashboard = "voterdashboard.php";
    }
    elseif($_SESSION['role'] == 'candidate'){
        $dashboard = "candidatedashboard.php";
    }
    elseif($_SESSION['role'] == 'admin'){
        $dashboard = "admindashboard.php";
    }
}

$sql = "
SELECT candidates.username, candidates.party, COUNT(votes.id) as total_votes
FROM candidates
LEFT JOIN votes ON candidates.id = votes.candidate_id
GROUP BY candidates.id
ORDER BY total_votes DESC
";

$result = $conn->query($sql);
$total = $conn->query("SELECT COUNT(*) as t FROM votes")->fetch_assoc()['t'];
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

    <title>Result Dashboard</title>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
      }

      /* BACKGROUND (SAME AS YOUR CODE) */
      body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        min-height: 100vh;
      }

      /* NAVBAR (SAME) */
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

      /* PROGRESS BAR */
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

      /* BADGE */
      .badge {
        background: #4facfe;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
      }

      /* RESPONSIVE */
      @media (max-width: 768px) {
        .container {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <div class="logo">Voting System</div>

      <div>
        <a href="<?= $dashboard ?>" class="anchor">Dashboard</a>
        <a href="about.html" class="anchor">About</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="logout.php" class="anchor">Logout</a>
      </div>
    </div>

    <!-- RESULTS -->
    <div class="container">
      <div class="card">
        <h2>Election Results</h2>

        <table>
          <tr>
            <th>Candidate</th>
            <th>Party</th>
            <th>Total Votes</th>
            <th>Percentage</th>
            <th>Status</th>
          <?php $rank=0; while($row = $result->fetch_assoc()){ $rank++; 
            $percent = $total ? ($row['total_votes']/$total)*100 : 0; ?>
            <tr class="<?= $rank==1 ? 'winner' : '' ?>">
              <td><?= $row['username'] ?></td>
              <td><?= $row['party'] ?></td>
              <td><?= $row['total_votes'] ?></td>
              <td>
                <div class="bar">
                  <div class="fill" style="width: <?= $percent ?>%"></div>
                </div>
                <?= round($percent,1) ?>%
              </td>
              <td><?= $rank==1 ? '<span class="badge">Winner</span>' : '-' ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </body>
</html>
